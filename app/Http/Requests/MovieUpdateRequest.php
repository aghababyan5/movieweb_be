<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieUpdateRequest extends FormRequest
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
            'id' => 'required',
            'title' => 'required|string',
            'release_date' => 'required|string|max:10',
            'country' => 'required|string',
            'genre' => 'required|string',
            'duration' => 'required|string|max:3',
            'description' => 'required|string',
            'img' => 'required|string',
            'video' => 'required|string'
        ];
    }
}