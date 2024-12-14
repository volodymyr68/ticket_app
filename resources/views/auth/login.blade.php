@extends('layouts.main')
@section('title', 'Login')
@section('content')
    @vite('resources/css/auth/login.css')

    <div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">Email</label>
            <input type="email"
                   name="email"
                   id="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
            >
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input type="password"
                   name="password"
                   id="password"
                   class="form-control @error('password') is-invalid @enderror"
            >
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="remember-me">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
@endsection
