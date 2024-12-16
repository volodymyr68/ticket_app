<!DOCTYPE html>
<html lang="en">
<head>
    @vite('resources/css/pdfs/ticket.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
</head>
<body>
<div class="container">
    <h1>Ticket Details</h1>

    <div class="card">
        <div class="card-header">
            Ticket #{{ $ticket->id }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-half">
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
                <div class="col-half">
                    <strong>Seats Taken:</strong>
                    <p>{{ $ticket->seats_taken }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-half">
                    <strong>Price:</strong>
                    <p>${{ number_format($ticket->price, 2) }}</p>
                </div>
                <div class="col-half">
                    <strong>Created At:</strong>
                    <p>{{ $ticket->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-half">
                    <strong>Updated At:</strong>
                    <p>{{ $ticket->updated_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
