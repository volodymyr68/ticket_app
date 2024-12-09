<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'vehicle_id' => ['required','exists:vehicles,id'],
            'seats_taken' => ['required','min:1','max:4'],
            'price' => ['required','min:1','max:1000']
        ];
    }
    public function messages(): array
    {
        return [
            'user_id.required' => 'User ID is required',
            'user_id.exists' => 'User ID does not exist',
            'vehicle_id.required' => 'Vehicle ID is required',
            'vehicle_id.exists' => 'Vehicle ID does not exist',
           'seats_taken.required' => 'Seats taken is required',
           'seats_taken.min' => 'Seats taken must be at least 1',
           'seats_taken.max' => 'Seats taken must not exceed 4',
            'price.required' => 'Price is required',
            'price.min' => 'Price must be at least 1',
            'price.max' => 'Price must not exceed 1000',
        ];
    }
}
