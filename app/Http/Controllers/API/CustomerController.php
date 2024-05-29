<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Customer;

class CustomerController extends Controller
{
    public function index(){
        $customer = Customer::all();
        $data = $customer->toArray();

        $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Customer Data retrieved successfully.'
        ];

        return response()->json($response, 200);
    }
}
