<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "userId" => 'required|integer',
            "title" => 'required|string',
            "body" => 'required|string',
        ];
    }
    public function authorize()
    {
        return true;
    }


    public function messages()
    {
        return [
            'userId.required' => 'The :attribute Id must be required.',
            'userId.integer' => 'The :attribute Id must be valid.',
            'title.required' => 'The :attribute must be required.',
            'title.string' => 'The :attribute must be a string of characters.',
            'body.string' => 'The :attribute must be a string of characters.',
            'body.required' => 'The :attribute Id must be required.',
        ];

    }
    public function attributes()
    {
        return [
            'userId' => 'Usuario',
            'title' => 'Title',
            'body' => "Post content",




        ];
    }  




}
