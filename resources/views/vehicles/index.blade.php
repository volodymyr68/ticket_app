@extends('layouts.main')

@section('content')
    @vite('resources/css/vehicles/index.css')
    <div class="container mt-4">
        <h1 class="mb-4">Vehicles Management</h1>
        <form action="{{ route('vehicle.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="quality">Quality</label>
                    <select id="quality" name="quality" class="form-control">
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
                    <select id="departure_city_id" name="departure_city_id" class="form-control">
                        <option value="">Select Departure City</option>
                        @foreach($cities as $city)
                            <option
                                value="{{ $city->id }}" {{ request()->get('departure_city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="destination_city_id">Destination City</label>
                    <select id="destination_city_id" name="destination_city_id" class="form-control">
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
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>

        </form>
        <a href="{{ route('vehicle.create') }}" class="btn btn-primary mb-3">Create New Vehicle</a>
        <button id="download-pdf" class="btn btn-primary w-100">Download PDF</button>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
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
                                <button type="submit" class="btn btn-sm btn-danger"
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
        <div class="pagination">
            {{ $vehicles->appends(request()->all())->links() }}
        </div>
    </div>

@endsection
