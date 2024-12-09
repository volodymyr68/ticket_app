<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <style>
        /* Similar styles as the previous ones */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

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

        .row {
            margin-bottom: 15px;
        }

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
    </style>
</head>
<body>
<div class="container">
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
        </div>
    </div>
</div>
</body>
</html>
