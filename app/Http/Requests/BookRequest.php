<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'author'      => 'nullable|string|max:255',
            'thumbnail'   => 'nullable|url|max:2048',
            'description' => 'nullable|string',
            'review'      => 'nullable|string',
            'rating'      => 'nullable|integer|min:1|max:5',
            'read_at'     => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'タイトルは必須です。',
            'title.max'      => 'タイトルは255文字以内で入力してください。',
            'author.max'     => '著者名は255文字以内で入力してください。',
        ];
    }
}
