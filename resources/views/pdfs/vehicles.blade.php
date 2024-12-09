<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            color: #555;
            margin-top: 20px;
        }

        /* Page break style */
        .page-break {
            page-break-after: always;
        }
    </style>
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

    <!-- Add page break if necessary (in case of pagination) -->
    @if ($page < $totalPages)
        <div class="page-break"></div>
    @endif

    <!-- Footer for page number -->
    <div class="footer">
        <p>Generated on {{ now()->format('d M Y, H:i') }} - Page {{ $page }} of {{ $totalPages }}</p>
    </div>
</div>
</body>
</html>
