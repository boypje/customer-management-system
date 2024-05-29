<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Customer;
use App\models\UsersTransaction;
use App\models\CallReport;
use App\models\Platform;
use DB;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User, App\Common;

class CallReportController extends Controller
{
    public function index(Request $request){
        // dd($request);
        // die();
        if($request->date != null){
            $tanggalYangDipilih = Carbon::parse($request->date)->format('Y-m-d');
            $data = DB::table('remark')
                    ->join('users','users.id','=','remark.user_id')
                    ->join('customer','customer.id','=','remark.customer_id') // asumsi bahwa kolom 'remark.customer_id' sesuai dengan kolom yang Anda inginkan untuk bergabung dengan 'customer.id'
                    ->where('customer.platform',$request->tim)
                    ->whereDate('remark.created_at', $tanggalYangDipilih)
                    ->select('remark.number','remark.duration','remark.call_start','remark.call_end','customer.nama_customer','users.fullname','remark.created_at');
        } else {
            $data = DB::table('remark')
            ->join('users','users.id','=','remark.user_id')
            ->join('customer','customer.id','=','remark.customer_id') // asumsi bahwa kolom 'remark.customer_id' sesuai dengan kolom yang Anda inginkan untuk bergabung dengan 'customer.id'
            ->where('customer.platform',$request->tim)
            ->select('remark.number','remark.duration','remark.call_start','remark.call_end','customer.nama_customer','users.fullname');
        }
            // ->OrderBy('users_transaction.created_at','desc');

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

    // $data = $data->where('users_transaction.transaction_type','like', '%' .$search. '%')
    //         ->orWhere('users_transaction.transaction_val','like', '%' .$search. '%')
    //         ->orWhere('users_transaction.date_upload','like', '%' .$search. '%');
    }

    $send_all_client = Platform::with('client')->distinct()->get();

    return view('admin.calling.index',['callingreportData'=>$data->paginate(25),'tim'=>$send_all_client,'id_tim'=>$request->tim,'dateSelected'=>$request->date]);
}


    public function exportCallingReportLink($id){
        $idDateArray = json_decode($id);
        // dd($idDateArray);
        // die();
        $id = $idDateArray[0];
        $date = $idDateArray[1];
        $dateNow = Carbon::parse($date);
        $tim = Platform::find($id);
        $data = DB::table('remark')
                ->join('users','users.id','=','remark.user_id')
                ->join('customer','customer.id','=','remark.customer_id') // asumsi bahwa kolom 'remark.customer_id' sesuai dengan kolom yang Anda inginkan untuk bergabung dengan 'customer.id'
                ->where('customer.platform',$id)
                ->whereNotNull('remark.call_end') // Add this condition to filter out records where duration is not null
                ->whereDate('remark.created_at', $dateNow->format('Y-m-d'))
                ->select('remark.status_call', 'remark.applicant_type', 'remark.number', 'remark.duration', 'remark.call_start', 'remark.call_end', 'remark.trigger_time', 'remark.role', 'customer.customer_id', 'users.employee_id', 'remark.description')
                ->get();
                // dd($data);
                // die();
        return (new FastExcel($data))->download('tele_calling_report_pt_sss_'.$dateNow->format('Ymd').'.csv', function($data) {
            return [
                'Loan Id' => $data->customer_id,
                'Allocation Month' => '',
                'Type Of Communication' => '',
                'Status' => $data->status_call,
                'Application Type' => ucfirst($data->applicant_type),                
                // 'Hasil Remark' => $data->description,
                'Call Type' => '',
                'Old Status' => '',
                'Call Response' => '',
                'Call To Mobile Number' => '',
                'Call From Mobile Number' => '',
                'DID Number' => '',
                'Duration' => $data->duration,
                'Call Start Time' => $data->call_start,
                'Call End Time' => $data->call_end,
                'Recording URL' => '',
                'Direction' => '',
                'Hangup Cause' => '',
                'Disconnected By' => '',
                'Dialer Disposition' => '',
                'Sub Disposition 1' => '',
                'Sub Disposition 2' => '',
                'Committed Amount' => '',
                'Author' => '',
                'Role' => $data->role,
                'Triggered Time' => date('m/d/Y H:i:s', strtotime($data->trigger_time)),
                'Error Name' => '',
                'Error Group Name' => '',
                'Error Description' => '',
                'Agent_id' => $data->employee_id,
                'ConnectTime' => '',
                'RingingDuration' => '',
                'WaitingDuration' => '',
                'LastChannel' => '',
                'PersonaName' => '',
                'Dial_Mode' => '',

            ];
        });
    }

    public function collectionActivityReport($id){
        $idDateArray = json_decode($id);
        $id = $idDateArray[0];
        $date = $idDateArray[1];
        $dateNow = Carbon::parse($date)->format('Y-m-d');
        $dateName = Carbon::parse($date)->format('Ymd');
        $tim = Platform::find($id);
        $data = DB::table('remark')
                ->join('users','users.id','=','remark.user_id')
                ->join('customer','customer.id','=','remark.customer_id') // asumsi bahwa kolom 'remark.customer_id' sesuai dengan kolom yang Anda inginkan untuk bergabung dengan 'customer.id'
                ->where('customer.platform',$id)
                ->whereNotNull('remark.status_call') // Add this condition to filter out records where duration is not null
                ->whereDate('remark.created_at', $dateNow)
                ->select('remark.status_call','remark.number','remark.updated_at','remark.duration','remark.call_start','remark.call_end','customer.updated_at as assigmentDate','remark.role','customer.customer_id','users.employee_id','remark.ptp')
                ->get();
                // dd($data);
                // die();
        return (new FastExcel($data))->download('collection_activity_report_pt_sss_'.$dateName.'.csv', function($data) {
            $data->status_call = str_replace('_', ' ', $data->status_call); // Replace underscores with spaces
            $data->status_call = ucwords($data->status_call); // Capitalize each word
            return [
                'assigned_dpd' => '',
                'assigned_date' => date('m-d-Y', strtotime($data->assigmentDate)),
                'marked_location' => '',
                'activity_date' => date('m-d-Y', strtotime($data->updated_at)),
                'agreementno' => $data->customer_id,
                'agent_id' => $data->employee_id,
                'agent_email' => '',
                'subcgid' => '',
                'product' => '',
                'agent_type' => $data->role,
                'contact_number' => $data->number,
                'disposition' => $data->status_call,
                'is_customer_met' => '',
                // 'ptp_date' => date('m-d-Y', strtotime($data->updated_at)),
                // 'ptp_date' => (!empty($data->ptp)) ? date('m-d-Y', strtotime($data->ptp)) ?: date('m-d-Y', strtotime($data->ptp, strtotime('Y-m-d'))) ?: 'Invalid Date' : '',
                'ptp_date' => (!empty($data->ptp)) ? date('m-d-Y', strtotime($data->ptp)) : '',
                'ATP_WTP_Q1' => '',
                'ATP_WTP_Q2' => '' ,
                'ATP_WTP_Q3' => '' ,
                'ATP_WTP_Q4' => '' ,
                'ATP_WTP_Q5' => '' ,
                'ATP_WTP_Q6' => '' ,
                'PersonaName' => '' ,
                'Contact_Type' => '' ,
                'Dial_Mode' => '' 

            ];
        });
    }
}
