<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\models\UsersTransaction;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use App\models\Customer;
use App\models\Payments;
use App\models\Remark;
use App\User;
use App\Common;
use App\models\Platform;
use DB;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{
    public function createPaymentCustomer(Request $request){
        // dd($request);
            $validator = Validator::make($request->all(), [
                'id' => 'string',
                'nominals' => 'min:5|regex:/^\d+(\.\d{1,2})?$/',
                'typ_remark' => 'string',
                'keterangan' => 'string|min:2',
                'nama_bukti_bayar' => 'mimes:jpeg,jpg,png,pdf|max:1000' //max size 1000Kb / 1Mb & menerima extnd jpeg,jpg,png,pdf
            ]);

            // dd($validator);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            // Assuming $request->dateTimeStart is in 'm/d/Y, h:i:s A' format
            $callStartTime = Carbon::createFromFormat('m/d/Y, h:i:s A', $request->dateTimeStart);
            // Extracting the time portion from the current date
            $dateNowTime = Carbon::now();
            // Calculating the difference in seconds
            // dd($callStartTime);
            $kategori = '';
        
            switch ($request->valRemark) {
                // case 'promise_to_pay':
                // case 'full_payment':
                // case 'partial_payment':
                case 'already_paid':
                case 'broken_ptp':
                case 'escalated':
                case 'language_not_communcable':
                case 'partial_recovered':
                case 'promise_to_pay_follow_up':
                case 'promise_to_settelment':
                case 'refused_to_pay':
                    $kategori = 'Present';
                    break;
                case 'centang2':
                case 'no_wa':
                case 'centang1':
                case 'confirmation_pending':
                case 'fraud_cheating':
                case 'callback':
                    $kategori = 'Unpresent';
                    break;
                default:
                    $kategori = 'Uncontacted';
            }

            $get_customer_id = Customer::findOrFail($request->id);
            
            $data_payment = [
                'user_id' => Auth::user()->id,
                'customer_id' => $get_customer_id->id,
                'description' => Common::cleanInput($request->keterangan),
                'nominal' => $request->nominal,
                'category_payment' => $request->typ_remark,
                // 'date_payment' =>  \Carbon\Carbon::now()->format('Y-m-d H:m')
                'date_payment' => \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d H:i'),
            ];

            $searchTerms = array('no_ec', 'EmergencyPhone');
            $spouse = 'mobile'; // Default value
            foreach ($searchTerms as $searchTerm) {
                if (stripos($request->applicant_type, $searchTerm) !== false) {
                    $spouse = 'spouse';
                    break; // Exit the loop if any search term is found
                }
            }
            $dateRemark = \Carbon\Carbon::now();

            if($request->customerId != null){
                $get_customer = Customer::FindOrFail($request->customerId);
    
                $data = [
                    'customer_id' => $get_customer->id,
                    'user_id' => Auth::user()->id,
                    'remark_type' => $request->typ_remark,
                    'description' => Common::cleanInput($request->keterangan),
                    'category' => $kategori,
                    'status_call' => $request->typ_remark,
                    'applicant_type' => $spouse,
                    'date_remark' => $dateRemark->format('Y-m-d H:m'),
                    'call_start' => Carbon::parse($request->dateNowStart)->format('H:i:s'),
                    // 'call_end' => Carbon::parse($request->dateNowEnd)->format('H:i:s'),
                    'number' => $request->phoneNumber,
                    'trigger_time' => Carbon::parse($request->dateNowStart)->format('Y-m-d H:m'),
                    'role' => 'SSS',
                    // 'duration' => $diffInSeconds,
                ];
                $createRemark = Remark::create($data);
            }
            if($request->rmk_id != null){
                $get_customer = Customer::Find($request->id);
                $getDataRemark = Remark::where('id', $request->rmk_id)
                                        ->first();
                                        // dd($getDataRemark->call_start);
                $carbonInstance = Carbon::parse($request->dateNowStart);
                // Calculate the difference in seconds between call start time and $dateNow
                $diffInSeconds = Carbon::parse($carbonInstance->format('H:i:s'))->diffInSeconds($getDataRemark->call_start);
                $data = [
                    'customer_id' => $get_customer->id,
                    'user_id' => Auth::user()->id,
                    'remark_type' => $request->typ_remark,
                    'description' => Common::cleanInput($request->keterangan),
                    'category' => $kategori,
                    'date_remark' => $dateRemark->format('Y-m-d H:m'),
                    'status_call'=> $request->typ_remark,
                    'applicant_type' => 'mobile',
                    // 'call_start' => $getDataRemark->call_start,
                    'call_end' => $carbonInstance->format('H:i:s'),
                    'number' => $get_customer->phone,
                    'trigger_time' => $dateRemark->format('Y-m-d H:m'),
                    'role' => 'SSS',
                    'duration' => $diffInSeconds,
                ];
                $createRemarks = $getDataRemark->update($data);
            }

            if($request->usr_id != null){
                $get_customer = Customer::Find($request->id);
                $getDataRemark = Remark::where('id', $request->usr_id)
                                        ->first();
                                        // dd($getDataRemark->call_start);
                $carbonInstance = Carbon::parse($request->dateNowStart);
                // Calculate the difference in seconds between call start time and $dateNow
                $diffInSeconds = Carbon::parse($carbonInstance->format('H:i:s'))->diffInSeconds($getDataRemark->call_start);
                $data = [
                    'customer_id' => $get_customer->id,
                    'user_id' => Auth::user()->id,
                    'remark_type' => $request->typ_remark,
                    'description' => Common::cleanInput($request->keterangan),
                    'category' => $kategori,
                    'date_remark' => $dateRemark->format('Y-m-d H:m'),
                    'status_call'=> $request->typ_remark,
                    'applicant_type' => 'mobile',
                    // 'call_start' => $getDataRemark->call_start,
                    'call_end' => $carbonInstance->format('H:i:s'),
                    'number' => $get_customer->phone,
                    'trigger_time' => $dateRemark->format('Y-m-d H:m'),
                    'role' => 'SSS',
                    'duration' => $diffInSeconds,
                ];
                $createRemarks = $getDataRemark->update($data);
            }

            // if (!empty($request->customerId)) {
            //     $getDataRemark = Remark::where('id', $request->usr_id)
            //                            ->latest()
            //                            ->first();
            // } else {
            //     $getDataRemark = Remark::where('customer_id', $get_customer_id->id)
            //                            ->where('user_id', Auth::user()->id)
            //                            ->latest()
            //                            ->first();
            // }
            
            // // If remark data exists, update it; otherwise, create a new one
            // if ($getDataRemark && $request->detailCus == null) {
            //     $diffInSeconds = Carbon::parse($dateNowTime->format('H:i:s'))->diffInSeconds($callStartTime->format('H:i:s'));
            //     $data = [
            //         'customer_id' => $get_customer_id->id,
            //         'user_id' => Auth::user()->id,
            //         'remark_type' => $request->typ_remark,
            //         'description' => $request->keterangan,
            //         'category' => $kategori,
            //         'call_end' => Carbon::createFromFormat('m/d/Y, h:i:s A', $request->dateTimeStart)->format('H:m:s'),
            //         'role' => 'SSS',
            //         'duration' => $diffInSeconds,
            //     ];
            //     $getDataRemark->update($data);
            // } else {
            //     $data = [
            //         'customer_id' => $get_customer_id->id,
            //         'user_id' => Auth::user()->id,
            //         'remark_type' => $request->typ_remark,
            //         'description' => Common::cleanInput($request->keterangan),
            //         'category' => $kategori,
            //         'applicant_type' => 'mobile',
            //         'status_call' => $request->typ_remark,
            //         'date_remark' => $callStartTime->format('Y-m-d H:m'),
            //         'call_start' => $callStartTime->format('H:m:s'),
            //         'call_end' => '',
            //         'number' => $get_customer_id->phone,
            //         'trigger_time' => $callStartTime->format('Y-m-d H:m'),
            //         'role' => 'SSS',
            //     ];
            //     Remark::create($data); // insert remark
            // }

                $payment = Payments::create($data_payment); // insert payment

                // upload image jika full payment
                if($request->typ_remark == "already_paid" || $request->typ_remark == "partial_recovered"){
                    $random_int = rand(1,9999);
                    $get_payment_data = Payments::where('customer_id',$get_customer_id->id)->get();
                    $file_bb = request()->file('nama_bukti_bayar');
                    $extn_bb = $file_bb->getClientOriginalExtension(); //get extension file
                    $file_bb->move("store_bukti_bayar/",'BB-'.date('dmY').'-cust-'.$get_customer_id->id.'-'.$random_int.'.'.$extn_bb); //moving file to directory
                    $path_bb = 'BB-'.date('dmY').'-cust-'.$get_customer_id->id.'-'.$random_int.'.'.$extn_bb;
                    $Data = [
                        'proof_of_payment'=>$path_bb,
                    ];
                    // dd($get_payment_data);

                    $payment->update($Data);
                }

                // record payment
                $record_save = UsersTransaction::create([
                    'uid' => Auth::user()->id, //id user yang login
                    'transaction_type' => "Payment",
                    'transaction_val' => 'Agen make '.$request->typ_remark.' with :'.$get_customer_id->nama_customer,
                    'date_upload'=>$dateNowTime->format('Y-m-d H:m')

                ]);
            // }
            return response()->json([!empty($createRemark) ? $createRemark->id : '' ]);
        // return response()->json(['success'=>'Added new records.']);
        // return $data_payment;
    }

    public function getdataPayment($id){
        $dataCustomer = Customer::find($id);
        $payment = Payments::where('customer_id',$dataCustomer->id)->get();
        // dd($payment);
        $tb = Datatables::of($payment)
        ->addIndexColumn()
                ->addColumn('waktu_pembayaran', function($data){
                    $date_remark = (new Carbon($data->date_payment))->format('d-m-Y');
                    return $date_remark;
                })
                ->addColumn('customer_name', function($data){
                    $customerData = Customer::find($data->customer_id);
                    // dd($customerData->nama_customer);
                    return $customerData->nama_customer;
                })
                ->addColumn('nominal', function($data){
                    return 'Rp '.number_format(( $data->nominal ), 2);
                })
                ->addColumn('category_payment', function($data){
                    $categ_payment ="";
                    if($data->category_payment == 'partial_recovered'){
                        $categ_payment = 'Patial Recovered';
                    }else{
                        $categ_payment = 'Already Paid';
                    }
                    return $categ_payment;
                })
                ->addColumn('user_remark', function($data){
                    $userData = User::find($data->user_id);
                    return $userData->employee_id;
                })
                ->addColumn('action', function($data){
                    $button = '';
                        $url= asset('/store_bukti_bayar/'.$data->proof_of_payment);
                        $button = '<a href="'.$url.'" title="Lihat  bukti bayar" class="btn btn-outline-success btn-sm"><i class="far fa-eye"></i></a>';
                    
                    return $button;
                })->make(true);
        return $tb;
    }

    public function UploadBuktiBayar(Request $request){
        // dd($request);
        $get_payment_data = Payments::find($request->id_payment);
        // $get_data_remark_by_id_cus = Customer::with('customer_remark')->latest('created_at')->first();
        $file_bb = request()->file('nama_bukti_bayar');
        $extn_bb = $file_bb->getClientOriginalExtension(); //get extension file
        $file_bb->move("store_bukti_bayar/",'BB-'.date('dmY').'.'.$extn_bb); //moving file to directory
        $path_bb = auth()->user()->id.'BB-'.date('dmY').'.'.$extn_bb;
        $Data = [
            'proof_of_payment'=>$path_bb,
        ];
        // dd($get_payment_data);

        $get_payment_data->update($Data);
        // // dd($get_payment_data);
        return $get_payment_data;

    }

    public function reportPayment(Request $request){
        // dd($request);
        // $data = Payments::with('customer_payments');
        $platformId = $request->tim;

        $data = Payments::with('customer_payments')
                        ->whereHas('customer_payments', function ($query) use ($platformId) {
                                $query->where('platform', $platformId);
                            })
                        ->orderBy('updated_at', 'desc');

        $search = Common::cleanInput($request->get('search'));

        if($search != null){
            // record search key
            $dateUpload = \Carbon\Carbon::now()->format('d-m-Y H:m');
            $record_create = [
                    'uid' => Auth::user()->id, //id user yang login
                    'transaction_type' =>'Searching Log in Payment',
                    'transaction_val' =>'Keyword : '.$search,
                    'date_upload'=>$dateUpload
                ];
            $record_save = UsersTransaction::create($record_create);

            $data = $data->where('payments.nominal','like', '%' .$search. '%')
                    ->orWhere('payments.description','like', '%' .$search. '%')
                    ->orWhere('payments.category_payment','like', '%' .$search. '%')
                    ->orWhereHas('customer_payments', function($q) use ($search) {
                        $q->where('customer_id', 'LIKE', '%' . $search . '%');
                        $q->where('nama_customer', 'LIKE', '%' . $search . '%');
                    });
        }
        $send_all_client = Platform::with('client')->distinct()->get();
        // dd($data->get());
        return view('admin.payment.index',['id_tim'=>$request->tim,'tim'=>$send_all_client,'paymentData'=>$data->sortable()->paginate(25)]);
    }

    public function verifyProofOfPayment($id){
        $data_payment = Payments::find($id);
        $data_payment->verified = 1;
        $data_payment->save();

        $dateUpload = \Carbon\Carbon::now()->format('d-m-Y H:m');
        $record_create = [
                'uid' => Auth::user()->id, //id user yang login
                'transaction_type' =>'verified proof of Payment',
                'transaction_val' =>'Data was verified by user '. User::find(auth()->user()->id)->fullname, // record verif user login
                'date_upload'=>$dateUpload
            ];
        $record_save = UsersTransaction::create($record_create);

        return redirect()->back()->with('SuccessVerifDatabyAdmin', 'Data Payment berhasil di Verifikasi');
        // return $data_payment;

    }
}
