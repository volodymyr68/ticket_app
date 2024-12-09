@extends('layouts.main')
@section('title', 'Login')
@section('content')
    @vite('resources/css/app.css')
    <style>
        /* Styles for the form */
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .remember-me input {
            margin-right: 5px;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
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
