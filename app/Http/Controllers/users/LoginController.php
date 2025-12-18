<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        try {
            return view('user-login');
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    public function login(UserLoginRequest $request)
    {
        try {
            $credentials = $request->validated();
            $credentials['status'] = 1;

            if (!Auth::guard('web_tenant')->attempt($credentials)) {
                return back()->withErrors('Invalid credentials');
            }

            $request->session()->regenerate();

            return redirect()->route('user.profile');
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    public function logout()
    {
        try {
            Auth::guard('web_tenant')->logout();

            return redirect()->route('UserLogin.show');
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }
}
