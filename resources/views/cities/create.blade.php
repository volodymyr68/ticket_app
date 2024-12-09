@extends('layouts.main')

@section('content')
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            font-size: 18px;
        }
        .form-body {
            padding: 20px;
        }
        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>

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
