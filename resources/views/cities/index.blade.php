@extends('layouts.main')

@section('content')
    @vite('resources/css/cities/index.css')

    <div class="container mt-4">
        <h1 class="mb-4">Cities Management</h1>


        <div class="row mt-3">
            <form class="form-inline mb-4" method="GET">
                <div class="form-group me-2">
                    <label for="filter" class="form-label">Filter</label>
                    <input type="text" class="form-control" id="filter" name="filter" placeholder="City name..."
                           value="{{ request('filter') }}">
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="{{ route('cities.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
        <a href="{{ route('cities.create') }}" class="btn btn-primary mb-3">
            <i class="glyphicon glyphicon-plus"></i> Create New City
        </a>


        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
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
                        <td>{{ $city->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $city->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ route('cities.edit', $city->id) }}">Edit</a>
                            <form action="{{ route('cities.destroy', $city->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this city?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
        </div>

        <div class="d-flex justify-content-center">
            {{ $cities->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
