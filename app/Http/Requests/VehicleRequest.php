<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'departure_city_id' => ['required', 'integer', 'exists:cities,id'],
            'destination_city_id' => ['required', 'integer', 'exists:cities,id'],
            'seats_quantity' => ['required', 'integer', 'min:1', 'max:4'],
        ];
    }

    public function messages(): array
    {
        return [
            'departure_city_id.required' => 'Departure cities is required',
            'departure_city_id.integer' => 'Departure cities must be an integer',
            'departure_city_id.exists' => 'Departure cities does not exist',
            'destination_city_id.required' => 'Destination cities is required',
            'destination_city_id.integer' => 'Destination cities must be an integer',
            'destination_city_id.exists' => 'Destination cities does not exist',
            'seats_quantity.required' => 'Seats quantity is required',
            'seats_quantity.integer' => 'Seats quantity must be an integer',
            'seats_quantity.min' => 'Seats quantity must be at least 1',
            'seats_quantity.max' => 'Seats quantity must not exceed 4',
        ];
    }
}
