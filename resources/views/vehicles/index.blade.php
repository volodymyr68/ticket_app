@extends('layouts.main')

<style>
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
    /* Основные стили контейнера */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Заголовок */
    .container h1 {
        color: #333;
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    /* Кнопки */
    .btn {
        font-size: 0.9rem;
        padding: 8px 12px;
        border-radius: 4px;
        text-transform: uppercase;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        color: #fff;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #fff;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e0a800;
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

    /* Таблица */
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

    /* Действия */
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

    /* Пагинация */
    .pagination {
        display: flex;
        justify-content: center;
        padding: 10px 0;
    }

    .pagination a, .pagination span {
        margin: 0 5px;
        padding: 8px 12px;
        background-color: #f9f9f9;
        border-radius: 4px;
        color: #007bff;
        text-decoration: none;
    }

    .pagination a:hover {
        background-color: #007bff;
        color: #fff;
    }

    .pagination .active {
        background-color: #007bff;
        color: #fff;
    }
</style>

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Vehicles Management</h1>

        <!-- Filter Form -->
        <form action="{{ route('vehicle.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="quality">Quality</label>
                    <select id="quality" name="quality" class="form-control">
                        <option value="">Select Quality</option>
                        <option value="Premium" {{ request()->get('quality') === 'Premium' ? 'selected' : '' }}>Premium</option>
                        <option value="Low" {{ request()->get('quality') === 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Middle" {{ request()->get('quality') === 'Middle' ? 'selected' : '' }}>Middle</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="departure_city_id">Departure City</label>
                    <select id="departure_city_id" name="departure_city_id" class="form-control">
                        <option value="">Select Departure City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request()->get('departure_city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="destination_city_id">Destination City</label>
                    <select id="destination_city_id" name="destination_city_id" class="form-control">
                        <option value="">Select Destination City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request()->get('destination_city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="ticket_cost">Ticket Cost</label>
                    <input type="number" id="ticket_cost" name="ticket_cost" class="form-control" value="{{ request()->get('ticket_cost') }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="seats_quantity">Seats Quantity</label>
                    <input type="number" id="seats_quantity" name="seats_quantity" class="form-control" value="{{ request()->get('seats_quantity') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <a href="{{ route('vehicle.create') }}" class="btn btn-primary mb-3">Create New Vehicle</a>

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
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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

        <!-- Pagination -->
        <div class="pagination">
            {{ $vehicles->appends(request()->all())->links() }}
        </div>
    </div>
@endsection
