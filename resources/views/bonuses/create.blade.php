@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-4">Create Bonus</h1>
        <form action="{{ route('bonuses.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Select User</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="" disabled selected>Select a User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Bonus Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('bonuses.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
