<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function viewLogin()
    {
        return view('Auth.login');
    }

    public function storeLogin(Request $request)
    {
        if (Auth::attempt(['EmailID' => $request->EmailID, 'password' => $request->password])) {
            return redirect()->route('home');
        }
        
         return redirect()->route('login.view')->with('error', 'Email or password incorrect');
    }
}
