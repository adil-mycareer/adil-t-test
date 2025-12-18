<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:mysql_user.users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'profile_image' => 'nullable|image|mimes:png,jpg,jpeg',
            'captcha' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value != session('captcha_answer')) {
                        $fail('Invalid captcha.');
                    }
                }
            ],
        ];
    }
}
