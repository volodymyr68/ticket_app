@extends('layouts.main')


@section('content')
    @vite('resources/css/users/show.css')
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
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this user?')">Delete
                        </button>
                    </form>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
@endsection

