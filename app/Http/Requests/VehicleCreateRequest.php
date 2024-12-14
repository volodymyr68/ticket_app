<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleCreateRequest extends FormRequest
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
            'departure_city_id' => ['required', 'exists:cities,id'],
            'destination_city_id' => ['required', 'exists:cities,id'],
            'seats_quantity' => ['required', 'integer', 'min:1', 'max:100'],
            'ticket_cost' => ['required', 'integer', 'min:1', 'max:1000'],
            'departure_time' => ['required', 'date'],
            'quality' => ['required', 'string', 'in:Premium,Low,Middle']
        ];
    }

    public function messages(): array
    {
        return [
            'departure_city_id.required' => 'The departure city is required.',
            'departure_city_id.exists' => 'The selected departure city does not exist.',

            'destination_city_id.required' => 'The destination city is required.',
            'destination_city_id.exists' => 'The selected destination city does not exist.',

            'seats_quantity.required' => 'The number of seats is required.',
            'seats_quantity.integer' => 'The number of seats must be a valid integer.',
            'seats_quantity.min' => 'The minimum number of seats is 1.',
            'seats_quantity.max' => 'The maximum number of seats is 4.',

            'ticket_cost.required' => 'The ticket cost is required.',
            'ticket_cost.decimal' => 'The ticket cost must be a valid integer.',
            'ticket_cost.min' => 'The minimum ticket cost is 1.',
            'ticket_cost.max' => 'The maximum ticket cost is 1000.',

            'departure_time.required' => 'The departure time is required.',
            'departure_time.date' => 'The departure time must be a valid date.',

            'quality.required' => 'The quality is required.',
            'quality.string' => 'The quality must be a string.',
            'quality.in' => 'The quality must be one of the following: Premium, Low, Middle.',
        ];
    }
}
