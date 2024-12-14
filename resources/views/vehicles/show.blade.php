@extends('layouts.main')

@section('content')
    @vite('resources/css/vehicles/show.css')

    <div class="container mt-5">
        <div class="details-container">
            <div class="details-header">
                Vehicle Details
            </div>
            <div class="details-body">
                <div class="detail-row">
                    <label for="quality">Quality</label>
                    <p>{{ $vehicle->quality }}</p>
                </div>
                <div class="detail-row">
                    <label for="departure_city">Departure City</label>
                    <p>{{ $vehicle->departureCity->name }}</p>
                </div>
                <div class="detail-row">
                    <label for="destination_city">Destination City</label>
                    <p>{{ $vehicle->destinationCity->name }}</p>
                </div>
                <div class="detail-row">
                    <label for="seats_quantity">Seats Quantity</label>
                    <p>{{ $vehicle->seats_quantity }}</p>
                </div>
                <div class="detail-row">
                    <label for="ticket_cost">Ticket Cost</label>
                    <p>${{ $vehicle->ticket_cost }}</p>
                </div>
                <div class="detail-row">
                    <label for="departure_time">Departure Time</label>
                    <p>{{ $vehicle->departure_time }}</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('vehicle.index') }}" class="btn btn-secondary">Back to List</a>
                    <a href="{{ route('vehicle.edit', $vehicle) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection
