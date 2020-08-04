<?php

namespace App\Http\Middleware;

use Closure;
use Concerns\InteractsWithInput;

class AuthGacha
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
		$request->bearerToken();
		$token = $request->header('Authorization');
		if($request->session()->has($token)){
				return $next($request);
		}else{
			var_dump($token);die;
		}
    }
}
