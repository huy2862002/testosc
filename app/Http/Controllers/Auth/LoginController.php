<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Traits\OAthTokenTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{

    protected $AuthService;


    public function __construct(AuthService $authService)
    {
        $this->AuthService = $authService;
    }
    public function viewLogin()
    {
        return view('Auth.login');
    }

    public function storeLogin(Request $request)
    {
        $result = (array) $this->AuthService->login($request);

        if ($result['status'] == 1) {
            session()->flush();
            session()->put('token', $result['access_token']);
            session()->put('exp', $result['expires_in']);
            return redirect()->route('home');
        }
        return back();
    }
    public function account(){
        return view('Auth.account');
    }
}
