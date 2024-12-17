<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'message' => ['required|string|min=0|max|1000']
        ];
    }

    public function messages(): array
    {
        return [
           'message.required' => 'The message field is required.',
           'message.string' => 'The message must be a string.',
           'message.min' => 'The message must be at least :min characters long.',
           'message.max' => 'The message must be no more than :max characters long.',
        ];
    }
}
