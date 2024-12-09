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
    </style>

    <div class="container mt-5">
        <div class="form-container">
            <div class="form-header">
                Create New Vehicle
            </div>
            <div class="form-body">
                <form action="{{ route('vehicle.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="quality" class="form-label">Quality</label>
                        <select id="quality" name="quality" class="form-control @error('quality') is-invalid @enderror" required>
                            <option value="" disabled selected>Select quality</option>
                            <option value="Low" {{ old('quality') == 'Low' ? 'selected' : '' }}>Low</option>
                            <option value="Middle" {{ old('quality') == 'Middle' ? 'selected' : '' }}>Middle</option>
                            <option value="Premium" {{ old('quality') == 'Premium' ? 'selected' : '' }}>Premium</option>
                        </select>
                        @error('quality')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="departure_city_id" class="form-label">Departure City</label>
                        <select id="departure_city_id" name="departure_city_id" class="form-control @error('departure_city_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Select departure city</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('departure_city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('departure_city_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="destination_city_id" class="form-label">Destination City</label>
                        <select id="destination_city_id" name="destination_city_id" class="form-control @error('destination_city_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Select destination city</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('destination_city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('destination_city_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="seats_quantity" class="form-label">Seats Quantity</label>
                        <input
                            type="number"
                            id="seats_quantity"
                            name="seats_quantity"
                            class="form-control @error('seats_quantity') is-invalid @enderror"
                            value="{{ old('seats_quantity') }}"
                            placeholder="Enter seats quantity"
                            required
                        >
                        @error('seats_quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
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
                            value="{{ old('ticket_cost') }}"
                            placeholder="Enter ticket cost"
                            required
                        >
                        @error('ticket_cost')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="departure_time" class="form-label">Departure Time</label>
                        <input
                            type="datetime-local"
                            id="departure_time"
                            name="departure_time"
                            class="form-control @error('departure_time') is-invalid @enderror"
                            value="{{ old('departure_time') }}"
                            required
                        >
                        @error('departure_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('vehicle.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
