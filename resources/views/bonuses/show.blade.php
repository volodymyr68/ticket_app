@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-4">Bonus Details</h1>
        <p><strong>ID:</strong> {{ $bonus->id }}</p>
        <p><strong>User id:</strong> {{$bonus->user->id }}</p>
        <p><strong>Amount:</strong> {{ $bonus->amount }}</p>
        <a href="{{ route('bonuses.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
