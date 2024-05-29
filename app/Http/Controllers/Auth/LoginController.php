<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $username;

    protected $maxAttempts = 3;
    protected $decayMinutes = 1;
    

    /**
    * Authenticated user that can access admin page, will be redirected automatically to admin dashboard
    **/
    protected function authenticated(Request $request, $user)
    {
        User::find(auth()->id())->update(['last_session'=>session()->getId()]);
        if ( $user->can('Access admin page') ) {
            return redirect('/admin');
        }

        return redirect('/');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findEmployeeId();
    }
    public function findEmployeeId(){
        $login = request()->input('login');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'employee_id'; 
        request()->merge([$fieldType => $login]);
        
        return $fieldType;
    }


    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        //return 'nip';
        return $this->username;
    }
}
