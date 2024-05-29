<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\models\Customer;
use JWTAuth;

class APILoginController extends Controller
{
    //Please add this method
    public function login() {
        // get email and password from request
        $credentials = request(['email']);

        $token = null;
        $user = User::whereEmail($credentials)->first();
        if(!$userToken=JWTAuth::fromUser($user)){
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        $token =JWTAuth::fromUser($user);

        return response()->json([
            'token' =>  $token,
            'type' => 'bearer', // you can ommit this
            'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
            
        ]);
    }

    public function getCustomer(){
        // $token = JWTAuth::getToken();
        // $user = JWTAuth::toUser($token);
        // $user_id = auth('api')->user()->id;
        $users = User::find(auth('api')->user()->id);
        // $users = Customer::where('user_id',$user_id)->get();
        // try {

        //     if (! $user = JWTAuth::parseToken()->authenticate()) {
        //         return response()->json(['user_not_found'], 404);
        //     }

        // } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

        //     return response()->json(['token_expired'], $e->getStatusCode());

        // } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        //     return response()->json(['token_invalid'], $e->getStatusCode());

        // } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

        //     return response()->json(['token_absent'], $e->getStatusCode());

        // }

        return response()->json($users);
    }
}