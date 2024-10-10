<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = User::where('api_token',$request->header('authorization'))->first();
         if($user){
             auth()->login($user);
            return $next($request);
        }else{
             abort('401','الرجاء تسجيل الدخول');
        }
     }
}
