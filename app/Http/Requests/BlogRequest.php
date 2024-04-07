<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:250',
            'short_description' => 'required',
            'long_description' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,bmp,png,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Blog title is required',
            'title.max' => 'Blog title can not be more than 250 characters',
            'short_description.required' => 'Blog short description is required',
            'long_description.required' => 'Blog long description is required',
            'category_id.required' => 'Blog category is required',
            'image.required' => 'Blog image is required',
            'image.image' => 'Blog image must be an image',
            'image.mimes' => 'Blog image must be an image',
            'image.max' => 'Blog image must be less than 2MB'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
