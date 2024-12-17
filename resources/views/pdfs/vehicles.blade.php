<!DOCTYPE html>
<html lang="en">
<head>
    @vite('resources/css/pdfs/vehicles.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles Report</title>
</head>
<body>
<div class="container">
    <h1>Vehicles Report</h1>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Quality</th>
            <th>Departure City</th>
            <th>Destination City</th>
            <th>Seats Quantity</th>
            <th>Ticket Cost</th>
            <th>Departure Time</th>
        </tr>
        </thead>
        <tbody>
        @forelse($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle->id }}</td>
                <td>{{ $vehicle->quality }}</td>
                <td>{{ $vehicle->departureCity->name ?? 'N/A' }}</td>
                <td>{{ $vehicle->destinationCity->name ?? 'N/A' }}</td>
                <td>{{ $vehicle->seats_quantity }}</td>
                <td>${{ number_format($vehicle->ticket_cost, 2) }}</td>
                <td>{{ $vehicle->departure_time }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align: center;">No vehicles available</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="statistics">
        <h3>Summary Statistics</h3>
        <p><strong>Total Vehicles:</strong> {{ count($vehicles) }}</p>
        <p><strong>Total Seats Sold:</strong>
            {{ $vehicles->sum('seats_quantity') }}
        </p>
        <p><strong>Total Ticket Revenue:</strong>
            ${{ number_format($vehicles->sum('ticket_cost'), 2) }}
        </p>
        <p><strong>Average Ticket Price:</strong>
            ${{ number_format($vehicles->avg('ticket_cost'), 2) }}
        </p>
        <p><strong>Highest Ticket Price:</strong>
            ${{ number_format($vehicles->max('ticket_cost'), 2) }}
        </p>
        <p><strong>Lowest Ticket Price:</strong>
            ${{ number_format($vehicles->min('ticket_cost'), 2) }}
        </p>

        <p><strong>Most Popular Quality:</strong>
            {{ $vehicles->groupBy('quality')->sortByDesc(function ($quality) {
                return $quality->count();
            })->keys()->first() ?? 'N/A' }}
        </p>

        <p><strong>City with Most Vehicles:</strong>
            {{ $vehicles->groupBy('departureCity.name')->sortByDesc(function ($city) {
                return $city->count();
            })->keys()->first() ?? 'N/A' }}
        </p>
    </div>

    <div class="footer">
        <p>Generated on {{ now()->format('d M Y, H:i') }} </p>
    </div>
</div>
</body>
</html>
