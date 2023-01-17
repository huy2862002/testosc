<?php

namespace App\Http\Middleware;

use App\Models\AccessToken;
use Closure;
use Illuminate\Http\Request;

class CheckAccessToken
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
        $mod_accessToken = new AccessToken();

        $last_accessToken = $mod_accessToken->getLast();
        
        if(strtotime($last_accessToken->expires_at) < strtotime(date('Y-m-d H:i:s'))){
            return redirect()->route('logout');
        }
        
        return $next($request);
       
    }
}
