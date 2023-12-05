<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
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
        $rules = [
            'categoryName' => 'required|max:250',
            'categoryIsActive' => 'required',
        ];
        if ($this->routeIs('category.create')) {
            $rules['categoryName'] .= '|unique:categories,name';
        } elseif ($this->routeIs('category.update')) {
            $rules['categoryName'] .= '|unique:categories,name,' . $this->route('id');
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'categoryName.required' => 'Category name is required',
            'categoryName.max' => 'Category name can not be more than 250 characters',
            'categoryName.unique' => 'Category name already exists',
            'categoryIsActive.required' => 'Category status is required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug' =>  Str::slug(strtolower($this->categoryName)),
        ]);
    }
}
