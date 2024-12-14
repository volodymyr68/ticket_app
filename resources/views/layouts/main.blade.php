<!doctype html>
<html lang="en">
<head>
    @vite('resources/css/layouts/main.css')
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div id="app">
    <nav>
        <a href="/">Home</a>
        @guest()
            <a href="{{ route('login') }}">Login</a>

            <a href="{{ route('google.redirect') }}" class="btn btn-primary"> Login with Google </a>
        @endguest
        @auth()
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >Logout</a>
            <a href="{{route('cities.index')}}">City</a>
            <a href="{{route('vehicle.index')}}">Vehicles</a>
            <a href="{{route('user.index')}}">Users</a>
            <a href="{{route('ticket.index')}}">Tickets</a>
            <a href="{{route('chats.index')}}">Chats</a>
            <div style="color: white">Hello {{Auth::user()->name}}</div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth
    </nav>

    <section>
        @yield('content')
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pzjw8f+ua7Kw1TIq0r8J0yJ9dK/4hzjN5w84c6d2DlWs1nsNOMJZl+qpzgE7r1rB"
            crossorigin="anonymous"></script>
</div>
</body>
</html>
