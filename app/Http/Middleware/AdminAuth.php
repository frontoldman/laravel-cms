<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdminAuth
{

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($this->auth->guest()){ //未登陆

            if($request->ajax()){
                return response('Unauthorized.', 401);
            }else{
                return redirect('/home');
            }

        }else{  //已登陆
            $user = $this->auth->user();

            if($user->role_id > 2){
                return redirect('/home');
            }
        }

        return $next($request);
    }
}
