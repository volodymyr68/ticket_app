@extends('layouts.main')
<style>
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
        list-style: none;
        padding: 0;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination li a,
    .pagination li span {
        padding: 8px 12px;
        border-radius: 4px;
        background-color: #f1f1f1;
        color: #007bff;
        text-decoration: none;
        transition: background-color 0.2s;
    }

    .pagination li a:hover {
        background-color: #ddd;
    }

    .pagination li.active span {
        background-color: #007bff;
        color: #fff;
        pointer-events: none;
    }

    .pagination li.disabled span {
        color: #ccc;
        pointer-events: none;
    }
</style>
@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Cities Management</h1>
        <a href="{{ route('cities.create') }}" class="btn btn-primary mb-3">
            <span class="glyphicon glyphicon-plus"></span> Create New City
        </a>

        <!-- Filter Form -->
        <form class="form-inline" method="GET">
            <div class="form-group mb-2">
                <label for="filter" class="col-sm-2 col-form-label">Filter</label>
                <input type="text" class="form-control" id="filter" name="filter" placeholder="City name..." value="{{ request('filter') }}">
            </div>
            <button type="submit" class="btn btn-default mb-2">Filter</button>
        </form>

        <!-- Table -->
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>@sortablelink('name', 'Name')</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($cities as $city)
                <tr>
                    <td>{{ $city->id }}</td>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->created_at }}</td>
                    <td>{{ $city->updated_at }}</td>
                    <td>
                        <a class="btn btn-sm btn-success" href="{{ route('cities.edit', $city->id) }}">Edit</a>
                        <form action="{{ route('cities.destroy', $city->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No cities found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div>
            {!! $cities->appends(Request::except('page'))->render() !!}
        </div>

        <p>
            Displaying {{ $cities->count() }} of {{ $cities->total() }} city(s).
        </p>
    </div>
@endsection
