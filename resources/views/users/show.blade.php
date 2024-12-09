@extends('layouts.main')
<style>
    .user-detail-card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-top: 20px;
    }

    .card-header {
        background-color: #f7f7f7;
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .user-name {
        font-size: 1.8rem;
        font-weight: bold;
        color: #333;
    }

    .card-body {
        padding: 20px;
    }

    .card-body .row {
        margin-bottom: 15px;
    }

    .card-body strong {
        color: #333;
    }

    .user-image {
        max-width: 150px;
        border-radius: 8px;
    }

    .btn {
        font-size: 1rem;
        padding: 10px 20px;
        border-radius: 4px;
        transition: background-color 0.2s ease-in-out, transform 0.1s;
        cursor: pointer;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        transform: scale(1.05);
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: scale(1.05);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: scale(1.05);
    }
</style>

@section('content')
    <div class="container mt-5">
        <h2>User Details</h2>

        <div class="card user-detail-card">
            <div class="card-header">
                <h3 class="user-name">{{ $user->name }}</h3>
                <small class="text-muted">{{ $user->email }}</small>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Role:</strong>
                        <span>{{ $user->role->name }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Sex:</strong>
                        <span>{{ $user->sex ? ucfirst($user->sex) : 'Not specified' }}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <strong>Phone Number:</strong>
                        <span>{{ $user->number ?? 'Not provided' }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Image:</strong>
                        <div>
                            @if($user->image)
                                <img width="100px" height="100px" src="{{ asset("storage/$user->image") }}" alt="image">
                            @else
                                <span>No image uploaded</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                    </form>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
@endsection

