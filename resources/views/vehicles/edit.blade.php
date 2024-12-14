@extends('layouts.main')

@section('content')
    @vite('resources/css/vehicles/edit.css')

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
                            <option value="Middle" {{ $vehicle->quality === 'Middle' ? 'selected' : '' }}>Middle
                            </option>
                            <option value="Premium" {{ $vehicle->quality === 'Premium' ? 'selected' : '' }}>Premium
                            </option>
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
