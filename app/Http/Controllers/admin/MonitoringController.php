<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Customer;
use App\models\Remark;
use App\models\Payments;
use App\models\UsersTransaction;
use App\models\Platform;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User, App\Common;
use Spatie\Permission\Models\Role;
use DB;
use Yajra\DataTables\DataTables;
use Rap2hpoutre\FastExcel\FastExcel;
use Exception;

class MonitoringController extends Controller
{

    public function index(Request $request)
    {
        $data = DB::table('users_transaction')
                    ->join('users','users.id','users_transaction.uid')
                    // ->leftjoin('customer_contacts','')
                    ->select('fullname','transaction_type','users_transaction.id as id','transaction_val','date_upload')
                    ->OrderBy('users_transaction.created_at','desc');

        $search = Common::cleanInput($request->get('search'));
        // dd($search != null);

        if($search != null){
            // record search key
            $dateUpload = \Carbon\Carbon::now()->format('d-m-Y H:m');
            $record_create = [
                    'uid' => Auth::user()->id, //id user yang login
                    'transaction_type' =>'Searching in Logging',
                    'transaction_val' =>'Keyword logging : '.$search,
                    'date_upload'=>$dateUpload
                ];
            $record_save = UsersTransaction::create($record_create);

            $data = $data->where('users_transaction.transaction_type','like', '%' .$search. '%')
                    ->orWhere('users_transaction.transaction_val','like', '%' .$search. '%')
                    ->orWhere('users_transaction.date_upload','like', '%' .$search. '%');
        }

        return view('admin.monitoring.index',['monitoringData'=>$data->paginate(25)]);
    }

    public function reportAgentRemark(Request $request){
        //start arif
        // $remark = Remark::with([
        //     'customer' => function($q){
        //         $q->where([['platform',4],['periode_start','<=',now()]])
        //           ->select('id','customer_id','nama_customer');
        //     },
        //     'user' => function($q){
        //         $q->select('employee_id','fullname');
        //     }])->select('remark_type','description','date_remark')->limit(20)->get();
        $data_user = Customer::where('platform',$request->tim)->select('user_id')->distinct()->get();
        $remark3 = User::with(['remarks','customer'=> function ($query) {
            $query->where('data_status','aktif');
        }])->whereIn('id',$data_user);
        // dd($request->tim);
        // cek data customer bedasarkan tim yang id tim yang di pilih dan user id yang tidak kosong
        // get data user yang memiliki remark dan mempunyai role desk collection
        // $data_monitoring = User::with('remarks')
        //                         ->whereIn('id', $data_user)
        //                         ->whereHas('roles', function($query){
        //                             $query->where('name', 'Desk Collection');
        //                         });
        // dd($data_monitoring->get());
        // die();
        //get data id dan nama di tb_platform 
        $send_all_client = Platform::with('client')->distinct()->get();
        // $send_all_client = DB::table('tb_platform')
        //                     ->join('customer','customer.platform','tb_platform.id')
        //                     ->distinct()
        //                     ->select('tb_platform.id as klien_id', DB::raw("CONCAT(tb_platform.nama,' ',customer.tim) AS tim"))
        //                     ->get();

        // dd($send_all_client);
        // die();
        return view('admin.monitoring.remarkReportAgent', ['data_remark'=>$remark3->paginate(25),'tim'=>$send_all_client,'id_tim'=>$request->tim]);
    }

    public function detailRemarkAgent(Request $request, $id)
    {   
        // get data user by id
        $data_agent = User::find($id);
        //get data customer yang sudah mempunyai record remark
        $data_detail_monitoring = DB::table('customer')
                                    ->where('customer.user_id',$data_agent->id)
                                    ->leftJoin('remark', 'customer.id', '=', 'remark.customer_id')
                                    ->where('remark.description','!=',null)
                                    ->select('customer.nama_customer','customer.customer_id as no_contract', 'remark.updated_at as date_remark','remark.description as remark_description','remark.remark_type','remark.category');
        return view('admin.monitoring.detailReportRemarkAgents', ['data_agent'=>$data_agent,'data_customer_agent'=>$data_detail_monitoring->orderBy('remark.updated_at', 'desc')->paginate(100)]);
    }

    public function reportAgentPayment(Request $request)
    {
        $data_user = Customer::where('platform',$request->tim)->whereDate('periode_start','<=',now())->select('user_id')->distinct()->get();
        $data_monitoring = User::with('payments')->whereIn('id', $data_user);
        // dd($data_monitoring->get());
        $send_all_client = Platform::all('id','nama');
        return view('admin.monitoring.paymentReportAgent', ['data_payment'=>$data_monitoring->paginate(25),'tim'=>$send_all_client,'id_tim'=>$request->tim]);
    }

    public function detailPaymentAgent(Request $request, $id)
    {
        $data_agent = User::find($id);
        $data_detail_monitoring = DB::table('customer')
                                    ->where('customer.user_id',$data_agent->id)
                                    ->leftJoin('payments', 'customer.id', '=', 'payments.customer_id')
                                    ->where('payments.proof_of_payment','!=',null)
                                    ->select('customer.nama_customer','customer.customer_id as no_contract', 'payments.updated_at as date_payments','payments.description as payments_description','payments.category_payment','payments.nominal','payments.proof_of_payment');
        return view('admin.monitoring.detailReportPaymentAgents', ['data_agent'=>$data_agent,'data_customer_agent'=>$data_detail_monitoring->orderBy('payments.updated_at', 'desc')->paginate(100)]);
    }

    public function exportRemarkAgent($id)
    {
        $agent = User::find($id);
        $data = DB::table('customer')
                ->where('customer.user_id', $agent->id)
                ->leftJoin('remark', 'customer.id', '=', 'remark.customer_id')
                ->whereNotNull('remark.description')
                ->select('customer.nama_customer','customer.customer_id as noContract', 'remark.updated_at as DateRemark','remark.description','remark.remark_type','remark.category')
                ->get();
                // dd($data);
        return (new FastExcel($data))->download('Remark-'.$agent->fullname.'.xlsx', function($data) {
            return [
                'Result Call' => $data->category,
                'Sub Result Call' => $data->remark_type,
                'Glosarium' => $data->description,
                'Remark' => '',
                'no contract' => $data->noContract,
                'nama customer' => $data->nama_customer,
            ];
        });
    }

    public function exportPaymentAgent($id)
    {
        $agent = User::find($id);
        $data = DB::table('customer')
                ->where('customer.user_id', $agent->id)
                ->leftJoin('payments', 'customer.id', '=', 'payments.customer_id')
                ->where('payments.proof_of_payment','!=',null)
                ->select('customer.nama_customer','customer.customer_id as no_contract', 'payments.updated_at as date_payments','payments.description as payments_description','payments.category_payment as type_payment','payments.proof_of_payment as bukti_bayar')
                ->get();
        // $url_bukti_bayar = url('store_bukti_bayar/'.$data->bukti_bayar);
                // http://localhost/Customer_app_trial_server/public/BB-15112022-cust-652.png
                // dd(url('store_bukti_bayar/'.$data[0]->bukti_bayar));
                // var_dump($url_bukti_bayar);
        return (new FastExcel($data))->download('Payment-'.$agent->fullname.'.xlsx', function($data) {
            return [
                'no_contract' => $data->no_contract,
                'nama_customer' => $data->nama_customer,
                'payment_type' => $data->type_payment,
                'payment_description' => $data->payments_description,
                'bukti_bayar' => url('store_bukti_bayar/'.$data->bukti_bayar),
                'date_payment' => $data->date_payments
            ];
        });
    }

    public function exportTimReportRemark($id){
        $tim = Platform::find($id);
        // dd($id);
        $data = DB::table('customer')
                ->where('customer.platform', $id)
                ->leftJoin('remark', 'customer.id', '=', 'remark.customer_id')
                ->whereNotNull('remark.description')
                ->select('customer.nama_customer','customer.customer_id as noContract', 'remark.updated_at as DateRemark','remark.description','remark.remark_type','remark.category','customer.user_id')
                ->get();
                // dd($data);
        return (new FastExcel($data))->download('Remark-'.$tim->nama.'.xlsx', function($data) {
            return [
                'Result Call' => $data->category,
                'Sub Result Call' => $data->remark_type,
                'Glosarium' => $data->description,
                'Remark' => $data->description,
                'no contract' => $data->noContract,
                'nama customer' => $data->nama_customer,
                'agent' => User::find($data->user_id)->fullname
            ];
        });
    }
}
