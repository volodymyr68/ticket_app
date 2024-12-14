<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/emails/ticket_bought.css')

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
