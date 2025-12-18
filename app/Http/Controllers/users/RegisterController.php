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
            return view('register-form');
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    public function storeRegister(RegisterUserRequest $request)
    {
        try {
            DB::transaction(function () use($request) {
                $path = '';
                if($request->hasFile('profile_image')) {
                    $file = $request->file('profile_image');
                    $extension = $file->extension();
                    $fileName = Str::uuid().$extension;

                    $path = $file->storeAs('profile', $fileName, 'public');
                }

                User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'image' => $path,
                    'status' => 0
                ]);
            });

            return redirect()->back()->with('message', 'User registered.');
        } catch (\Throwable $th) {
            info($th->getMessage());

            return redirect()->route('user.registerForm')->withErrors('Something went wrong');
        }
    }
}
