@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Bonuses Management</h1>
        <a href="{{ route('bonuses.create') }}" class="btn btn-primary mb-3">Create New Bonus</a>

        @if ($bonuses->isEmpty())
            <p class="text-center">No bonuses found.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($bonuses as $bonus)
                        <tr>
                            <td>{{ $bonus->id }}</td>
                            <td>{{ $bonus->user->id ?? 'N/A' }}</td>
                            <td>${{ number_format($bonus->amount, 2) }}</td>
                            <td>
                                <a href="{{ route('bonuses.show', $bonus) }}" class="btn btn-primary btn-sm">Show</a>
                                <a href="{{ route('bonuses.edit', $bonus) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('bonuses.destroy', $bonus) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this bonus? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
