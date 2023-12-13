<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'title'        => 'required|string',
            'release_date' => 'required|string|max:10',
            'country'      => 'required|string',
            'genres'       => 'required|array',
            'genres.*'     => 'required|string',
            'duration'     => 'required|string|max:3',
            'description'  => 'required|string',
            'img'          => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'img_slider'   => 'required|image|mimes:jpg,jpeg,png,gif',
            'video'        => 'required|string',
            'imdb_score'   => 'required|numeric|regex:/^\d+(\.\d{1})?$/',
        ];
    }

}
