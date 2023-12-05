<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
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
        if ($this->is('api/user/register')) {
            // Rules for registration
            return [
                'userName' => 'required|min:2|max:100',
                'userEmail' => ['required', 'email', Rule::unique('users', 'email')],
                'userProfession' => 'required|min:2|max:100',
                'userProfilePhoto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'password' => 'required|min:6|max:100',
                'confirm_password' => 'required|same:password',
            ];
        } elseif ($this->is('api/user/login')) {
            // Rules for login
            return [
                'userEmail' => 'required|email',
                'password' => 'required',
            ];
        }
    }

    public function messages()
    {
        if ($this->is('api/user/register')) {
            // Messages for registration
            return [
                'userName.required' => 'The User name field is required.',
                'userName.min' => 'The User name must be at least 2 characters.',
                'userName.max' => 'The User name may not be greater than 100 characters.',
                'userEmail.required' => 'The user email field is required.',
                'userEmail.email' => 'The user email must be a valid email address.',
                'userEmail.unique' => 'The user email has already been taken.',
                'userProfession.required' => 'The user profession field is required.',
                'userProfession.min' => 'The user profession must be at least :min characters.',
                'userProfession.max' => 'The user profession may not be greater than :max characters.',
                'password.required' => 'The password field is required.',
                'password.min' => 'The password must be at least 6 characters.',
                'password.max' => 'The password may not be greater than 100 characters.',
                'confirm_password.required' => 'The confirm password field is required.',
                'confirm_password.same' => 'The confirm password must be the same as password.',
            ];
        } elseif ($this->is('api/user/login')) {
            // Messages for login
            return [
                'userEmail.required' => 'The User email field is required for login.',
                'userEmail.email' => 'Please enter a valid email address for login.',
                'password.required' => 'The password field is required for login.',
            ];
        }
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
        if ($this->is('api/user/register')) {
            // Modify input for registration
            $this->merge([
                'name' => ucfirst($this->userName),
                'email' => strtolower($this->userEmail),
            ]);
        }
    }
}
