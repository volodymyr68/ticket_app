@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h2>Edit User</h2>

        <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header">
                    <h4>Edit User Details</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                               class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role_id">Role</label>
                        <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                            @foreach($roles as $role)
                                <option
                                    value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <select name="sex" id="sex" class="form-control @error('sex') is-invalid @enderror">
                            <option value="">Not specified</option>
                            <option value="male" {{ old('sex', $user->sex) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('sex', $user->sex) == 'female' ? 'selected' : '' }}>Female
                            </option>
                            <option value="other" {{ old('sex', $user->sex) == 'other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                        @error('sex')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="number">Phone Number</label>
                        <input type="text" name="number" id="number" value="{{ old('number', $user->number) }}"
                               class="form-control @error('number') is-invalid @enderror">
                        @error('number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Profile Image</label>
                        <input type="file" name="image" id="image"
                               class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        @if($user->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $user->image) }}" alt="User Image"
                                     class="img-fluid user-image">
                            </div>
                        @else
                            <span>No image uploaded</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

<style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .card-header {
        background-color: #f7f7f7;
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 4px;
        margin-bottom: 15px;
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

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: scale(1.05);
    }

    .text-danger {
        font-size: 0.875rem;
    }
</style>
