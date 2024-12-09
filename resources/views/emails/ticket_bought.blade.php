<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 20px;
            color: #333333;
        }

        .email-body ul {
            list-style: none;
            padding: 0;
        }

        .email-body li {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .email-footer {
            background-color: #f9f9f9;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #666666;
        }

        .highlight {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>Thank You for Your Purchase!</h1>
    </div>
    <div class="email-body">
        <p>Hello, {{$user->name}}</p>
        <p>We are pleased to confirm your ticket purchase. Here are the details:</p>
        <ul>
            <li><span class="highlight">Ticket Number:</span> {{ $ticket->id }}</li>
            <li><span class="highlight">Vehicle Number:</span> {{ $ticket->vehicle->id }}</li>
            <li><span class="highlight">Vehicle Quality:</span> {{ $ticket->vehicle->quality }}</li>
            <li><span class="highlight">Seats Quantity:</span> {{ $ticket->vehicle->seats_quantity }}</li>
            <li><span class="highlight">Ticket Price:</span> ${{ $ticket->vehicle->ticket_cost }}</li>
            <li><span class="highlight">Departure Time:</span> {{ $ticket->vehicle->departure_time }}</li>
            <li><span class="highlight">Departure City:</span> {{ $ticket->vehicle->departureCity->name }}</li>
            <li><span class="highlight">Destination City:</span> {{ $ticket->vehicle->destinationCity->name }}</li>
        </ul>
        <p>We hope you have a great journey!</p>
    </div>
    <div class="email-footer">
        <p>© {{ date('Y') }} Your Travel Company. All rights reserved.</p>
    </div>
</div>
</body>
</html>
