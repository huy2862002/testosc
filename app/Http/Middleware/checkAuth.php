<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        if(auth()->check() == false){
            return response()->json([
                "message"=>"You haven't connected your account yet",
                'status'=>0
            ]);
        }else{
            $payload = auth()->payload();
            if($payload['exp'] - time() > 3600){
                return response()->json([
                    "message"=>"Token Expiration",
                    'status'=>0
                ]);
            }
        };
        return $next($request);
    }
}
