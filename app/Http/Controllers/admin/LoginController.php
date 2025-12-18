<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        try {
            return view('admin.login');
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    public function login(AdminLoginRequest $request)
    {
        try {
            $credentials = $request->validated();

            if (!Auth::attempt($credentials)) {
                return back()->withErrors([
                    'email' => 'Invalid credentials'
                ]);
            }

            $request->session()->regenerate();

            return redirect()->route('admin.home');
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    public function logout()
    {
        try {
            Auth::logout();

            return redirect()->route('admin.login.show');

        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }
}
