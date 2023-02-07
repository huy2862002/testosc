<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class AuthService
{
    public function __construct()
    {
        //
    }

    public function login($request)
    {
        $url = config('constants.linkLocal') . '/api/auth/login';

        $response = Http::asForm()->post($url, ['EmailID' => $request->EmailID, 'password' => $request->password])->body();

        return json_decode($response);
    }

    public function logout(){


        $url =  config('constants.linkLocal') . '/api/auth/logout';
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Bearer ' . session()->get('token'),
        ])->post($url)->body();

        return json_decode($response);
    }
}
