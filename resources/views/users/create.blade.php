@extends('layouts.main')

<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
        color: #333;
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-control {
        margin-bottom: 20px;
    }

    .form-control label {
        font-weight: bold;
        color: #333;
        display: block;
        margin-bottom: 5px;
    }

    .form-control input, .form-control select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
        outline: none;
        transition: border-color 0.2s ease-in-out;
    }

    .form-control input:focus,
    .form-control select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .form-control input[type="file"] {
        padding: 5px;
        font-size: 0.9rem;
    }

    .text-danger {
        font-size: 0.9rem;
        color: #dc3545;
        margin-top: 5px;
    }

    .btn-primary {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 4px;
        transition: background-color 0.2s ease-in-out, transform 0.1s;
        text-align: center;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.02);
    }

    .btn-primary:active {
        background-color: #003f7f;
        transform: scale(0.98);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
        padding: 10px 15px;
        font-size: 1rem;
        border-radius: 4px;
        transition: background-color 0.2s ease-in-out, transform 0.1s;
        margin-left: 10px;
        cursor: pointer;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: scale(1.02);
    }

    .btn-secondary:active {
        background-color: #43484d;
        transform: scale(0.98);
    }

    input.is-invalid, select.is-invalid {
        border-color: #dc3545;
    }

    .form-control input[type="file"]::file-selector-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .form-control input[type="file"]::file-selector-button:hover {
        background-color: #0056b3;
    }
</style>

@section('content')
    <div class="container mt-5">
        <h2>Create New User</h2>

        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="@error('name') is-invalid @enderror">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="@error('email') is-invalid @enderror">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-control">
                <label for="role_id">Role</label>
                <select name="role_id" id="role_id" class="@error('role_id') is-invalid @enderror">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-control">
                <label for="sex">Sex</label>
                <select name="sex" id="sex" class="@error('sex') is-invalid @enderror">
                    <option value="">Not specified</option>
                    <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('sex') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('sex')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-control">
                <label for="number">Phone Number</label>
                <input type="text" name="number" id="number" value="{{ old('number') }}"
                       class="@error('number') is-invalid @enderror">
                @error('number')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-control">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror">
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
