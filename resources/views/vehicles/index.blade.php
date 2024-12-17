@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Vehicles Management</h1>
        <form id="filterForm" action="{{ route('vehicle.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="quality">Quality</label>
                    <select id="quality" name="quality" class="form-select">
                        <option value="">Select Quality</option>
                        <option value="Premium" {{ request()->get('quality') === 'Premium' ? 'selected' : '' }}>
                            Premium
                        </option>
                        <option value="Low" {{ request()->get('quality') === 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Middle" {{ request()->get('quality') === 'Middle' ? 'selected' : '' }}>Middle
                        </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="departure_city_id">Departure City</label>
                    <select id="departure_city_id" name="departure_city_id" class="form-select">
                        <option value="">Select Departure City</option>
                        @foreach($cities as $city)
                            <option
                                value="{{ $city->id }}" {{ request()->get('departure_city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="destination_city_id">Destination City</label>
                    <select id="destination_city_id" name="destination_city_id" class="form-select">
                        <option value="">Select Destination City</option>
                        @foreach($cities as $city)
                            <option
                                value="{{ $city->id }}" {{ request()->get('destination_city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="ticket_cost">Ticket Cost</label>
                    <input type="number" id="ticket_cost" name="ticket_cost" class="form-control"
                           value="{{ request()->get('ticket_cost') }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="seats_quantity">Seats Quantity</label>
                    <input type="number" id="seats_quantity" name="seats_quantity" class="form-control"
                           value="{{ request()->get('seats_quantity') }}">
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="{{ route('vehicle.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </div>
        </form>
        <a href="{{ route('vehicle.create') }}" class="btn btn-primary mb-3">Create New Vehicle</a>
        <button id="generate-pdf" class="btn btn-primary mb-3">Generate PDF</button>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>@sortablelink('quality', 'Quality')</th>
                    <th>Departure City</th>
                    <th>Destination City</th>
                    <th>@sortablelink('seats_quantity', 'Seats Quantity')</th>
                    <th>@sortablelink('ticket_cost', 'Ticket Cost')</th>
                    <th>@sortablelink('departure_time', 'Departure Time')</th>
                    <th>Actions</th>
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
                        <td>
                            <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('vehicle.destroy', $vehicle->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No vehicles found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $vehicles->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        const pusher = new Pusher('0c48b8eef40cc5d2451b', {
            cluster: 'eu'
        });

        const channel = pusher.subscribe('DownloadVehicleReport');
        channel.bind('App\\Events\\DownloadAdminPdf', function (data) {
            const fileUrl = data.url;

            const link = document.createElement('a');
            link.href = fileUrl;
            link.setAttribute('download', 'vehicle_report.pdf');

            document.body.appendChild(link);
            link.click();

            document.body.removeChild(link);
        });

        document.getElementById('generate-pdf').addEventListener('click', function () {
            const filters = {
                quality: document.getElementById('quality').value,
                departure_city_id: document.getElementById('departure_city_id').value,
                destination_city_id: document.getElementById('destination_city_id').value,
                ticket_cost: document.getElementById('ticket_cost').value,
                seats_quantity: document.getElementById('seats_quantity').value,
            };

            fetch("{{ route('vehicle.download') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify(filters),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('PDF is being generated!');
                    } else {
                        alert('Failed to generate PDF. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        });
    </script>
@endsection
