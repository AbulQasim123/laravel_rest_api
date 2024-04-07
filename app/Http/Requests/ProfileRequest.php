<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfileRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:password'
        ];
    }


    public function messages()
    {
        return [
            'old_password.required' => 'The Old password field is required.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.max' => 'The password may not be greater than 100 characters.',
            'confirm_password.required' => 'The confirm password field is required.',
            'confirm_password.same' => 'The confirm password must be the same as password.',
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

    public function prepareForValidation()
    {
        $this->merge([
            'name' => ucfirst($this->userName),
            'email' => strtolower($this->userEmail),
        ]);
    }
}
