<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\User;
use App\models\Platform;
use App\models\Client;
use App\models\BucketClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PlatformController extends Controller
{
    public function index(){
        return view('admin.platform.index');
    }

    public function formPlatform(){
        // dd($dataMgr);
        return view('admin.platform.form');
    }

    public function subKlien(){
        return view('admin.platform.formSubKlien');
    }

    public function store(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(), [
            'nama_platform' => 'required|string|min:4',
            // 'kk' => 'string|nullable',
        ]);

        $data = [
            'client_name' =>$request['nama_platform'],
        ];

        $user = Client::create($data);
        return 'data platform sukses terinput'.$user;
    }

    public function storeKlien(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(), [
            'klien' => 'required|string|min:4',
            'listAgent' => 'string|nullable',
        ]);

        $data = [
            'bucket_name' =>$request['nama_bucket'],
            'dpd' =>$request['dpd'],
        ];

        $user = Platform::create($data);
        return 'data platform sukses terinput'.$user;
    }

    public function storeBucketKlien(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(), [
            'nama_platform' => 'required|string|min:4',
            // 'kk' => 'string|nullable',
        ]);

        $data = [
            'nama' =>$request['nama_platform'],
        ];

        $user = BucketClient::create($data);
        return 'data platform sukses terinput'.$user;
    }

    public function getData(){
        $querys = Client::get();
        // dd($querys);
        $tb = Datatables::of($querys)
        ->addIndexColumn()
                ->addColumn('nama', function($data){
                    return $data->client_name;
                })
                ->addColumn('action', function($data){
                    // $button = '<a href="'.route('viewSlipSalary',$data->id).'" data-toggle="tooltip" title="Lihat Slip Salary" class="btn btn-outline-info btn-sm"><i class="ni ni-single-copy-04"></i></a>';
                    $button ='btn';
                    return $button;
                })
                ->make(true);
        return $tb;
    }

    public function getDataBucketClinet(){
        $querys = BucketClient::get();
        // dd($querys);
        $tb = Datatables::of($querys)
        ->addIndexColumn()
                ->addColumn('nama', function($data){
                    return $data->nama;
                })
                ->addColumn('dpd', function($data){
                    return $data->dpd;
                })
                ->addColumn('action', function($data){
                    // $button = '<a href="'.route('viewSlipSalary',$data->id).'" data-toggle="tooltip" title="Lihat Slip Salary" class="btn btn-outline-info btn-sm"><i class="ni ni-single-copy-04"></i></a>';
                    $button ='btn';
                    return $button;
                })
                ->make(true);
        return $tb;
    }

    public function getDataClinet(){
        $querys = Client::get();
        $tb = Datatables::of($querys)
        ->addIndexColumn()
                ->addColumn('client_name', function($data){
                    return $data->client_name;
                })
                ->addColumn('total_agent', function($data){
                    $array = json_decode($data->bucket_detail, true);
                    $total_agent = is_array($array) ? count($array) : '-';
                    return $total_agent;
                })
                ->addColumn('action', function($data){
                    // $button = '<a href="'.route('viewSlipSalary',$data->id).'" data-toggle="tooltip" title="Lihat Slip Salary" class="btn btn-outline-info btn-sm"><i class="ni ni-single-copy-04"></i></a>';
                    $button ='btn';
                    return $button;
                })
                ->make(true);
        return $tb;
    }

    public function storemanageAgent(Request $request){
        $namaTim = $request->klien;
        // Fetch the existing Client
        $client = Client::find($namaTim);
        // Decode the existing bucket_detail JSON string to an array
        $existingBucketDetail = json_decode($client->bucket_detail, true);
        // Initialize or update the nested array for each agent
        foreach ($request->nama_agent as $agent) {
            // Only update if the agent does not exist in the existing bucket_detail
            if (!isset($existingBucketDetail[$agent])) {
                $existingBucketDetail[$agent] = [
                    "bucket" => null,
                    'id_cust' => null
                ];
            }
        }
        // Encode the updated bucket_detail back to JSON
        $resultManageAgent = json_encode($existingBucketDetail);
        // Update the Client with the new bucket_detail
        $client->update(['bucket_detail' => $resultManageAgent]);
        return $client;
        
    }

    public function viewAgentManage(){
        // $results = User::select('id','fullname')->where('jabatan', ['Desk Collection', 'Leader DC'])->get();
        $existingUsers = Client::select('bucket_detail')
            ->get()
            ->pluck('bucket_detail') // Extract bucket_detail values
            ->flatMap(function ($bucketDetail) {
                return array_keys(json_decode($bucketDetail, true) ?? []);
            })
            ->unique()
            ->toArray();

        $results = User::select('id', 'fullname')
            ->where('jabatan', ['Desk Collection', 'Leader DC'])
            ->whereNotIn('id', $existingUsers)
            ->get();
        $tim = Client::get();
        // dd($formattedResults);
        // die();
        return view('admin.platform.viewManageAgent',['namaAgent'=>$results,'tim'=>$tim]);
    }
}
