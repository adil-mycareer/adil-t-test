<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegister()
    {
        try {

            $num1 = rand(1, 9);
            $num2 = rand(1, 9);

            session([
                'captcha_answer' => $num1 + $num2
            ]);

            return view('register-form', compact('num1', 'num2'));
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    public function storeRegister(RegisterUserRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $path = '';
                if ($request->hasFile('profile_image')) {
                    $file = $request->file('profile_image');
                    $extension = $file->extension();
                    $fileName = Str::uuid() . $extension;

                    $path = $file->storeAs('profile', $fileName, 'public');
                }

                User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'image' => $path,
                    'status' => 0
                ]);

                session()->forget('captcha_answer');
            });

            return redirect()->back()->with('message', 'User registered.');
        } catch (\Throwable $th) {
            info($th->getMessage());

            return redirect()->route('user.registerForm')->withErrors('Something went wrong');
        }
    }
}
