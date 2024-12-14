@extends('layouts.main')

@section('content')
    @vite('resources/css/cities/show.css')


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
