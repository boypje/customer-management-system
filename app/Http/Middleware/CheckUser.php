<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->user_status == 'nonaktif') {         
            $message = 'Mohon maaf, status Kepegawaian anda NONAKTIF, anda tidak diperkenankan LOGIN ke dalam sistem.';
            auth()->logout();     
            return redirect()->route('login')->withMessage($message); 
        }

        //start single session

        // if(auth()->check()){
        //     // If current session id is not same with last_session column
        //     if(auth()->user()->last_session != session()->getId()){
        //         // do logout
        //         auth()->logout();

        //         // Redirecto login page
        //         return redirect('login');
        //     }
        // }

        //end single session
        
        return $next($request);
    }
}
