<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    protected $AuthService;

    public function __construct(AuthService $authService)
    {
        $this->AuthService = $authService;
    }
    public function logout(){
        $result = (array) $this->AuthService->logout();
        if($result['status'] == 1){
            session()->forget('token');
            return redirect()->route('login.view');
        }
    }
}
