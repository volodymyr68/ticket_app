@extends('layouts.main')

@section('content')
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            font-size: 18px;
        }

        .form-body {
            padding: 20px;
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .invalid-feedback {
            color: red;
            font-size: 0.875rem;
        }
    </style>

    <div class="container mt-5">
        <div class="form-container">
            <div class="form-header">
                Edit Vehicle
            </div>
            <div class="form-body">
                <form action="{{ route('vehicle.update', $vehicle->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="quality" class="form-label">Quality</label>
                        <select
                            id="quality"
                            name="quality"
                            class="form-control @error('quality') is-invalid @enderror"
                            required
                        >
                            <option value="Low" {{ $vehicle->quality === 'Low' ? 'selected' : '' }}>Low</option>
                            <option value="Middle" {{ $vehicle->quality === 'Middle' ? 'selected' : '' }}>Middle</option>
                            <option value="Premium" {{ $vehicle->quality === 'Premium' ? 'selected' : '' }}>Premium</option>
                        </select>
                        @error('quality')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="departure_city_id" class="form-label">Departure City</label>
                        <select
                            id="departure_city_id"
                            name="departure_city_id"
                            class="form-control @error('departure_city_id') is-invalid @enderror"
                            required
                        >
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ $city->id == $vehicle->departure_city_id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('departure_city_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="destination_city_id" class="form-label">Destination City</label>
                        <select
                            id="destination_city_id"
                            name="destination_city_id"
                            class="form-control @error('destination_city_id') is-invalid @enderror"
                            required
                        >
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ $city->id == $vehicle->destination_city_id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('destination_city_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="seats_quantity" class="form-label">Seats Quantity</label>
                        <input
                            type="number"
                            id="seats_quantity"
                            name="seats_quantity"
                            class="form-control @error('seats_quantity') is-invalid @enderror"
                            value="{{ $vehicle->seats_quantity }}"
                            required
                        >
                        @error('seats_quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="ticket_cost" class="form-label">Ticket Cost</label>
                        <input
                            type="number"
                            id="ticket_cost"
                            name="ticket_cost"
                            class="form-control @error('ticket_cost') is-invalid @enderror"
                            step="0.01"
                            value="{{ $vehicle->ticket_cost }}"
                            required
                        >
                        @error('ticket_cost')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="departure_time" class="form-label">Departure Time</label>
                        <input
                            type="datetime-local"
                            id="departure_time"
                            name="departure_time"
                            class="form-control @error('departure_time') is-invalid @enderror"
                            value="{{ date('Y-m-d\TH:i', strtotime($vehicle->departure_time)) }}"
                            required
                        >
                        @error('departure_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('vehicle.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
