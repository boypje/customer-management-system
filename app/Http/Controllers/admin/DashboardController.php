<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\models\Remark;
use App\models\Payments;
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isDC']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_customer = DB::table('customer')
                ->join('users', 'users.id', '=', 'customer.user_id')
                ->where('customer.user_id', Auth::user()->id)
                ->where('data_status','aktif')
                ->select('customer.id')
                ->get();
        $data_payment = DB::table('customer')
                ->join('users', 'users.id', '=', 'customer.user_id')
                ->where('customer.user_id', Auth::user()->id)
                ->where('data_status','aktif')
                ->join('payments','customer.id','=','payments.customer_id')
                ->where('proof_of_payment','!=',null)
                ->select('payments.id','payments.nominal')
                ->get();
        $data_remark = DB::table('customer')
                ->join('users', 'users.id', '=', 'customer.user_id')
                ->where('customer.user_id', Auth::user()->id)
                ->where('data_status','aktif')
                ->join('remark','customer.id','=','remark.customer_id')
                ->select('remark.id')
                ->get();
                
        return view('admin.dashboard.index',['customer'=>$data_customer,'remark'=>$data_remark,'payment'=>$data_payment]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
