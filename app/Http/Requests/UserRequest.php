<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required|string|unique:users|regex:/^\S*$/', // without spaces
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ];
    }
}
