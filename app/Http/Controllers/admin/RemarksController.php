<?php

namespace App\Http\Controllers\admin;

use App\models\Remark;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Customer;
use App\models\CallReport;
use Illuminate\Support\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\models\UsersTransaction;
use App\Common;
use Illuminate\Support\Facades\Validator;

class RemarksController extends Controller
{
    public function remarkCustomer(Request $request){
        // dd($request);
            $validator = Validator::make($request->all(), [
                // 'id' => 'required',
                'typ_remark' => 'string',
                'keterangan' => 'string|min:2',
            ]);

            // dd($validator);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()->all()]);
            }

            $kategori = '';
            // Mengecek setiap nilai dalam array gabungan
            switch ($request->valRemark) {
                // case 'promise_to_pay':
                // case 'full_payment':
                // case 'partial_payment':
                case 'already_paid' :
                case 'broken_ptp_contacted' :
                case 'escalated' :
                case 'language_not_communcable' :
                case 'partial_recovered' :
                case 'promise_to_pay_follow_up' :
                case 'promise_to_settelment' :
                case 'refused_to_pay' :
                    $kategori = 'Present';
                    break;
                // case 'centang2':
                // case 'no_wa':
                // case 'centang1':
                case 'confirmation_pending' :
                case 'fraud_cheating' :
                case 'callback' :
                    $kategori = 'Unpresent';
                    break;
                default:
                    $kategori = 'Uncontacted';
            }
            $id = intval(str_replace("ph_", "", $request->id));
            // dd($request->id_aftercall_remark);
            // die();
            // $getDataCustomer = Customer::find($request->customerId);
            // $getDataCallReport = CallReport::where('customer_id',$getDataCustomer->id)->where('agent_id',Auth::user()->id);
            $dateRemark = \Carbon\Carbon::now();
            // $get_customer = Customer::FindOrFail(($request->customerId != '') ?  : $request->id);
            $callStartTime = Carbon::parse($request->dateNowStart)->format('H:i:s');
            if($request->customerId != null){
                $get_customer = Customer::FindOrFail($request->customerId);
                $data = [
                    'customer_id' => $get_customer->id,
                    'user_id' => Auth::user()->id,
                    'remark_type' => $request->typ_remark,
                    'description' => Common::cleanInput($request->keterangan),
                    'category' => $kategori,
                    'date_remark' => $dateRemark->format('Y-m-d H:m'),
                    'status_call'=> $request->statusRemarked,
                    'call_start' => Carbon::parse($request->dateNowStart)->format('H:i:s'),
                    // 'call_end' => Carbon::parse($request->dateNowEnd)->format('H:i:s'),
                    'number' => $get_customer->phone,
                    'trigger_time' => Carbon::parse($request->dateNowStart)->format('Y-m-d H:i:s'),
                    'role' => 'SSS',
                    // 'duration' => $diffInSeconds,
                ];
                $hasilRemark = Remark::create($data);

            } elseif($request->customerId == null && $request->usr_id == null){
                $get_customer = Customer::FindOrFail($request->id);
                $getDataRemark = Remark::where('customer_id', $get_customer->id)
                                        ->where('user_id', Auth::user()->id)
                                        ->latest() // Get the latest remark
                                        ->first();
                                        // dd($getDataRemark->call_start);
                $carbonInstance = Carbon::parse($request->dateTimeStart);
                // Calculate the difference in seconds between call start time and $dateNow
                $diffInSeconds = Carbon::parse($carbonInstance->format('H:i:s'))->diffInSeconds($getDataRemark->call_start);
                $data = [
                    'customer_id' => $get_customer->id,
                    'user_id' => Auth::user()->id,
                    'remark_type' => $request->typ_remark,
                    'description' => Common::cleanInput($request->keterangan),
                    'category' => $kategori,
                    'date_remark' => $dateRemark->format('Y-m-d H:m'),
                    'status_call'=> $request->statusRemarked,
                    'applicant_type' => 'mobile',
                    'call_start' => $getDataRemark->call_start,
                    'call_end' => $carbonInstance->format('H:i:s'),
                    'ptp' => ($request->date_payment == null) ? NULL : $request->date_payment,
                    'number' => $get_customer->phone,
                    // 'trigger_time' => $getDataRemark->trigger_time,
                    'role' => 'SSS',
                    'duration' => $diffInSeconds,
                ];
                // dd($data);
                $hasilRemarks = $getDataRemark->update($data);
            } else {
                $get_customer = Customer::FindOrFail($request->id);
                $getDataRemark = Remark::where('id', $request->usr_id)
                                        ->where('user_id', Auth::user()->id)
                                        ->latest() // Get the latest remark
                                        ->first();
                                        // dd($getDataRemark->call_start);
                $carbonInstance = Carbon::parse($request->dateTimeStart);
                // Calculate the difference in seconds between call start time and $dateNow
                $diffInSeconds = Carbon::parse($carbonInstance->format('H:i:s'))->diffInSeconds($getDataRemark->call_start);
                $data = [
                    'customer_id' => $get_customer->id,
                    'user_id' => Auth::user()->id,
                    'remark_type' => $request->typ_remark,
                    'description' => Common::cleanInput($request->keterangan),
                    'category' => $kategori,
                    'date_remark' => $dateRemark->format('Y-m-d H:m'),
                    'status_call'=> $request->statusRemarked,
                    'applicant_type' => 'mobile',
                    'call_start' => $getDataRemark->call_start,
                    'call_end' => $carbonInstance->format('H:i:s'),
                    'ptp' => ($request->date_payment == null) ? NULL : $request->date_payment,
                    'number' => $get_customer->phone,
                    // 'trigger_time' => $getDataRemark->trigger_time,
                    'role' => 'SSS',
                    'duration' => $diffInSeconds,
                ];
                // dd($data);
                $hasilRemarks = $getDataRemark->update($data);
            }

            $record_save = UsersTransaction::create([
                'uid' => Auth::user()->id, //id user yang login
                'transaction_type' => 'Remark',
                'transaction_val' => 'Agen remark '.$request->valRemark.' for customer :'.$get_customer->nama_customer,
                // $get_customer_id->nama_customer.", Remark : ".$request->typ_remark,
                'date_upload'=>$dateRemark
            ]);
        // return $data_remark;
           return response()->json([!empty($hasilRemark) ? $hasilRemark->id : '']);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    }

    public function getdataRemark($id){
        $dataCustomer = Customer::find($id);
        $remark = Remark::where('customer_id',$dataCustomer->id)->get();
        // dd($remark);
        $tb = Datatables::of($remark)
        ->addIndexColumn()
                ->addColumn('date_remark', function($data){
                    $date_remark = (new Carbon($data->date_remark))->format('d-m-Y');
                    return $date_remark;
                })
                ->addColumn('customer_name', function($data){
                    $customerData = Customer::find($data->customer_id);
                    // dd($customerData->nama_customer);
                    return $customerData->nama_customer;
                })
                ->addColumn('type_remark', function($data){
                    // $link = '';
                    // $link = "<a href='#'>".$data->remark_type."</a>";
                    return $data->remark_type;
                })
                ->addColumn('category', function($data){
                    return $data->category;
                })
                ->addColumn('ket', function($data){
                    return $data->description;
                })
                ->addColumn('user_remark', function($data){
                    $userData = User::find($data->user_id);
                    return $userData->employee_id;
                })
                ->addColumn('action', function($data){
                    $button = '';
                    // $button = '<a href="#" onclick="upload_bukti_bayar('.$data->id.')"  data-toggle="tooltip" title="Upload Bukti Bayar" class="btn btn-outline-primary btn-sm"><i class="ni ni-cloud-upload-96"></i></a>';
                    return $button;
                })->make(true);
        return $tb;
    }

    public function recordDetailRemarkCall(Request $request){
        // dd($request->nama_bukti_bayar);
        $validator = Validator::make($request->all(), [
            'keterangan' => 'string|min:2',
            // 'date_payment' => 'required|date_format:"Y-m-d'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        
        if ($request->idCustomer == null) {
            $id = intval(str_replace("ph_", "", $request->id));
        } else {
            $id = $request->idCustomer;
        }


        
        $kategori = '';
        
        switch ($request->valRemark) {
            // case 'promise_to_pay':
            // case 'full_payment':
            // case 'partial_payment':
            case 'already_paid' :
            case 'broken_ptp_contacted' :
            case 'escalated' :
            case 'language_not_communcable' :
            case 'partial_recovered' :
            case 'promise_to_pay_follow_up' :
            case 'promise_to_settelment' :
            case 'refused_to_pay' :
                $kategori = 'Present';
                break;
            // case 'centang2':
            // case 'no_wa':
            // case 'centang1':
            case 'confirmation_pending' :
            case 'fraud_cheating' :
            case 'callback' :
                $kategori = 'Unpresent';
                break;
            default:
                $kategori = 'Uncontacted';
        }
        
        $searchTerms = array('no_ec', 'EmergencyPhone');
        $spouse = 'mobile'; // Default value
        foreach ($searchTerms as $searchTerm) {
            if (stripos($request->applicant_type, $searchTerm) !== false) {
                $spouse = 'spouse';
                break; // Exit the loop if any search term is found
            }
        }
        $dateRemark = \Carbon\Carbon::now();
        // baru 
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
                'trigger_time' => Carbon::parse($request->dateNowStart)->format('Y-m-d H:i:s'),
                'role' => 'SSS',
                // 'duration' => $diffInSeconds,
            ];
            $createRemark = Remark::create($data);
        }else{
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
                // 'trigger_time' => $getDataRemark->trigger_time,
                'role' => 'SSS',
                'duration' => $diffInSeconds,
            ];
            $createRemarks = $getDataRemark->update($data);
        }
        // end baru 
        
        $record_save = UsersTransaction::create([
            'uid' => Auth::user()->id, //id user yang login
            'transaction_type' => 'Remark',
            'transaction_val' => 'Agen remark '.$request->valRemark.' for customer :'.$get_customer->nama_customer,
            // $get_customer_id->nama_customer.", Remark : ".$request->typ_remark,
            'date_upload'=>$dateRemark
        ]);
        return response()->json([!empty($createRemark) ? $createRemark->id : '']);
    }
    
}
