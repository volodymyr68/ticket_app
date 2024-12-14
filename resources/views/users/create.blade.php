@extends('layouts.main')

@section('content')
    @vite('resources/css/users/create.css')
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
