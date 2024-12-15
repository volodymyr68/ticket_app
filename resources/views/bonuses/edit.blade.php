@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Bonus</h1>
        <form action="{{ route('bonuses.update', $bonus) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control" value="{{ $bonus->amount }}"
                       required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('bonuses.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
