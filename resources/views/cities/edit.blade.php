@extends('layouts.main')

@section('content')
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .form-header {
            background-color: #ffc107;
            color: #333;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            font-size: 18px;
            text-align: center;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            color: #333;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
        }
        .btn {
            width: 48%;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>

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
                <input type="text" id="name" name="name" value="{{ old('name', $city->name) }}" class="form-control" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('cities.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
