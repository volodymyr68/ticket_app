@extends('layouts.main')

@section('content')
    <div class="container mt-4">

        <h1 class="mb-4">Ticket Management</h1>

        <form method="GET" action="{{ route('ticket.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="min_price" class="form-label">Min Price</label>
                    <input type="number" name="min_price" id="min_price" class="form-control"
                           value="{{ request('min_price') }}" placeholder="Enter minimum price">
                </div>
                <div class="col-md-4">
                    <label for="max_price" class="form-label">Max Price</label>
                    <input type="number" name="max_price" id="max_price" class="form-control"
                           value="{{ request('max_price') }}" placeholder="Enter maximum price">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('ticket.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>@sortablelink('vehicle_id', 'Vehicle')</th>
                    <th>@sortablelink('seats_taken', 'Seats Taken')</th>
                    <th>@sortablelink('price', 'Price')</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->vehicle->id ?? 'N/A' }}</td>
                        <td>{{ $ticket->seats_taken }}</td>
                        <td>${{ number_format($ticket->price, 2) }}</td>
                        <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $ticket->updated_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('ticket.show', $ticket->id) }}" class="btn btn-sm btn-primary">Show</a>
                            <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this ticket?')">Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No tickets found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        <div class="d-flex justify-content-center">
            {{ $tickets->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
