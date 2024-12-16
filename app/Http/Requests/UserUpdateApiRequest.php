<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateApiRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'role_id' => ['nullable', 'exists:roles,id'],
            'sex' => ['nullable', 'in:male,female,other'],
            'number' => ['nullable', 'string', 'max:15'],
            'image' => ['nullable', 'image'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not exceed 255 characters',

            'email.required' => 'Email is required',
            'email.string' => 'Email must be a string',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must not exceed 255 characters',
            'email.unique' => 'Email already exists',

            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.min' => 'Password must be at least 8 characters long',

            'role_id.required' => 'Role is required',
            'role_id.exists' => 'Selected role does not exist',

            'sex.in' => 'Sex must be one of the following: male, female, other',

            'number.string' => 'Number must be a string',
            'number.max' => 'Number must not exceed 15 characters',

            'image.image' => 'Uploaded file must be an image',
            'image.mimes' => 'Image must be in jpeg, png, jpg, or gif format',
            'image.max' => 'Image size must not exceed 2MB',
        ];
    }
}
