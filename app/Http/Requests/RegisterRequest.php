<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'ユーザー名は必須です。',
            'email.required'     => 'メールアドレスは必須です。',
            'email.email'        => 'メールアドレスの形式が正しくありません。',
            'email.unique'       => 'このメールアドレスはすでに使用されています。',
            'password.required'  => 'パスワードは必須です。',
            'password.confirmed' => 'パスワードが一致しません。',
            'password.min'       => 'パスワードは8文字以上で入力してください。',
        ];
    }
}
