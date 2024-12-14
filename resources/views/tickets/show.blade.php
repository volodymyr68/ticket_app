@extends('layouts.main')

@section('content')
    @vite('resources/css/tickets/show.css')
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
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this ticket?')">Delete Ticket
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
