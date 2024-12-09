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
        $rules = [

            'sex' => ['nullable', 'in:male,female,other'],
            'number' => ['nullable', 'string', 'max:15'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'],
        ];
        if ($this->isMethod('post')) {
            $rules['name'] = ['required', 'string', 'max:255'];
            $rules['password'] = ['required', 'string', 'min:8'];
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email'];
            $rules['role_id'] = ['nullable', 'exists:roles,id'];
        }
        return $rules;
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            // Name
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not exceed 255 characters',

            // Email
            'email.required' => 'Email is required',
            'email.string' => 'Email must be a string',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must not exceed 255 characters',
            'email.unique' => 'Email already exists',

            // Password
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.min' => 'Password must be at least 8 characters long',

            // Role
            'role_id.required' => 'Role is required',
            'role_id.exists' => 'Selected role does not exist',

            // Sex
            'sex.in' => 'Sex must be one of the following: male, female, other',

            // Number
            'number.string' => 'Number must be a string',
            'number.max' => 'Number must not exceed 15 characters',

            // Image
            'image.image' => 'Uploaded file must be an image',
            'image.mimes' => 'Image must be in jpeg, png, jpg, or gif format',
            'image.max' => 'Image size must not exceed 2MB',
        ];
    }
}
