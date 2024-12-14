@extends('layouts.main')

@section('content')
    @vite('resources/css/cities/index.css')
    <div class="container mt-4">
        <h1 class="mb-4">Cities Management</h1>
        <a href="{{ route('cities.create') }}" class="btn btn-primary mb-3">
            <span class="glyphicon glyphicon-plus"></span> Create New City
        </a>

        <!-- Filter Form -->
        <form class="form-inline" method="GET">
            <div class="form-group mb-2">
                <label for="filter" class="col-sm-2 col-form-label">Filter</label>
                <input type="text" class="form-control" id="filter" name="filter" placeholder="City name..."
                       value="{{ request('filter') }}">
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
                        <form action="{{ route('cities.destroy', $city->id) }}" method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete
                            </button>
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
