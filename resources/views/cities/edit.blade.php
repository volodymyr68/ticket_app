@extends('layouts.main')

@section('content')
    @vite('resources/css/cities/edit.css')

    <div class="form-container">
        <div class="form-header">
            Edit City
        </div>

        <!-- Отображение ошибок -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cities.update', $city->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">City Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $city->name) }}" class="form-control"
                       required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('cities.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
