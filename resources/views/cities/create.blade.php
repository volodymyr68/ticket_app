@extends('layouts.main')

@section('content')
    @vite('resources/css/cities/create.css')

    <div class="container mt-5">
        <div class="form-container">
            <div class="form-header">
                Create New City
            </div>
            <div class="form-body">
                <form action="{{ route('cities.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">City Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control"
                            placeholder="Enter city name"
                            required
                        >
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('cities.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
