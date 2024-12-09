@extends('layouts.main')

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .container h1 {
        color: #333;
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .btn {
        font-size: 0.9rem;
        padding: 8px 12px;
        border-radius: 4px;
        text-transform: uppercase;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-info {
        background-color: #17a2b8;
        color: #fff;
        border: none;
    }

    .btn-info:hover {
        background-color: #138496;
        color: #fff;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
        border: none;
    }

    .btn-danger:hover {
        background-color: #b02a37;
        color: #fff;
    }

    .table {
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        margin-bottom: 20px;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }

    .table th, .table td {
        padding: 12px 15px;
        text-align: left;
    }

    .table th {
        background-color: #343a40;
        color: #fff;
        font-weight: bold;
    }

    .table td {
        color: #555;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tbody tr:hover {
        background-color: #e9ecef;
        cursor: pointer;
    }

    .table td .btn {
        margin-right: 5px;
    }

    .table td .btn:last-child {
        margin-right: 0;
    }

    .table tbody tr td {
        text-align: center;
        font-style: italic;
        color: #999;
    }
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px 0;
    }

    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 8px 16px;
        margin: 0 4px;
        background-color: #007bff;
        color: #fff;
        border-radius: 4px;
        text-decoration: none;
        font-size: 1rem;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .pagination a:hover,
    .pagination span:hover {
        background-color: #0056b3;
        color: #fff;
    }

    .pagination .disabled {
        background-color: #e0e0e0;
        color: #b5b5b5;
        pointer-events: none;
    }

    .pagination .active {
        background-color: #28a745;
        color: #fff;
    }

    /* Стиль для первой и последней страницы */
    .pagination .first,
    .pagination .last {
        font-weight: bold;
    }

    /* Убираем стандартные стили для пагинации в некоторых браузерах */
    .pagination li {
        list-style: none;
    }

    .pagination li:first-child a {
        border-radius: 4px 0 0 4px;
    }

    .pagination li:last-child a {
        border-radius: 0 4px 4px 0;
    }
    /* Основн
</style>

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Ticket Management</h1>

        <!-- Форма фильтров -->
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
                    <a href="{{ route('ticket.index') }}" class="btn btn-secondary">Clear</a>
                </div>
            </div>
        </form>

        <!-- Таблица билетов -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>@sortablelink('id', 'Ticket ID')</th>
                    <th>@sortablelink('vehicle_id', 'Vehicle')</th>
                    <th>@sortablelink('seats_taken', 'Seats Taken')</th>
                    <th>@sortablelink('price', 'Price')</th>
                    <th>@sortablelink('created_at', 'Created At')</th>
                    <th>@sortablelink('updated_at', 'Updated At')</th>
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
                            <a href="{{ route('ticket.show', $ticket->id) }}" class="btn btn-sm btn-info">View</a>
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
        </div>

        <div class="pagination">
            {{ $tickets->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection
