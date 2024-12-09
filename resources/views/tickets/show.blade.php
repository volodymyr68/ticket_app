@extends('layouts.main')

<style>
    /* Container for the ticket details */
    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Card styling */
    .card {
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .card-header {
        background-color: #343a40;
        color: #fff;
        font-size: 1.2rem;
        font-weight: bold;
        text-align: center;
        padding: 10px;
    }

    .card-body {
        padding: 20px;
        background-color: #fff;
    }

    /* Row for displaying ticket details */
    .row {
        margin-bottom: 15px;
    }

    /* Column for each detail */
    .col-md-6 {
        padding: 5px;
    }

    strong {
        font-size: 1rem;
        color: #333;
    }

    p {
        font-size: 1.1rem;
        color: #555;
    }

    /* Action buttons styling */
    .btn {
        font-size: 0.9rem;
        padding: 8px 15px;
        border-radius: 4px;
        text-transform: uppercase;
        transition: background-color 0.2s ease-in-out;
        margin-right: 10px;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #fff;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
        border: none;
    }

    .btn-danger:hover {
        background-color: #b02a37;
    }
</style>

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Ticket Details</h1>

        <div class="card">
            <div class="card-header">
                Ticket #{{ $ticket->id }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Vehicle:</strong>
                        <ul>
                            <li>Number : {{ $ticket->vehicle->id }}</li>
                            <li>Quality : {{ $ticket->vehicle->quality }}</li>
                            <li>Seats quantity : {{ $ticket->vehicle->seats_quantity }}</li>
                            <li>Price : {{ $ticket->vehicle->ticket_cost }}</li>
                            <li>Departure time : {{ $ticket->vehicle->departure_time }}</li>
                            <li>Departure City : {{ $ticket->vehicle->departureCity->name }}</li>
                            <li>Destination City : {{ $ticket->vehicle->destinationCity->name }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <strong>Seats Taken:</strong>
                        <p>{{ $ticket->seats_taken }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Price:</strong>
                        <p>${{ number_format($ticket->price, 2) }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Created At:</strong>
                        <p>{{ $ticket->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Updated At:</strong>
                        <p>{{ $ticket->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>

                <!-- Action buttons -->
                <a href="{{ route('ticket.index') }}" class="btn btn-secondary">Back to Ticket List</a>
                <!-- Form for deleting ticket -->
                <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ticket?')">Delete Ticket</button>
                </form>
            </div>
        </div>
    </div>
@endsection
