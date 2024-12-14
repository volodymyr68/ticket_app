<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
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
            'client_id' => ['required', 'exists:users,id']
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.required' => 'Client ID is required',
            'client_id.exists' => 'Client ID does not exist',
        ];
    }
}
