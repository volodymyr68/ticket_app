@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="text-center">
                <h1 class="mb-4">Welcome to Admin Panel</h1>
                <p class="mb-4">Please login to access the dashboard</p>
                @guest()
                    <a href="{{ route('login') }}">Login</a>
                @endguest
                @auth()
                    <h3>You are now logged in!</h3>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endauth
            </div>
        </div>
    </div>
@endsection
