@extends('layouts.main')

@section('content')
    <style>
        .details-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .details-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            font-size: 18px;
            text-align: center;
        }
        .details-body {
            padding: 20px;
        }
        .details-item {
            margin-bottom: 15px;
        }
        .details-item label {
            font-weight: bold;
            color: #333;
        }
        .details-actions {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            border-top: 1px solid #eaeaea;
            background-color: #f1f1f1;
            border-radius: 0 0 8px 8px;
        }
        .btn {
            width: 48%;
        }
    </style>

    <div class="details-container">
        <div class="details-header">
            City Details
        </div>
        <div class="details-body">
            <div class="details-item">
                <label>ID:</label>
                <p>{{ $city->id }}</p>
            </div>
            <div class="details-item">
                <label>Name:</label>
                <p>{{ $city->name }}</p>
            </div>
            <div class="details-item">
                <label>Created At:</label>
                <p>{{ $city->created_at }}</p>
            </div>
            <div class="details-item">
                <label>Updated At:</label>
                <p>{{ $city->updated_at }}</p>
            </div>
        </div>
        <div class="details-actions">
            <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('cities.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
