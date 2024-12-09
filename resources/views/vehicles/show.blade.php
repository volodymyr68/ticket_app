@extends('layouts.main')

@section('content')
    <style>
        .details-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .details-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            font-size: 18px;
            text-align: center;
        }
        .details-body {
            padding: 20px;
        }
        .details-body .detail-row {
            margin-bottom: 15px;
        }
        .details-body .detail-row label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
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
