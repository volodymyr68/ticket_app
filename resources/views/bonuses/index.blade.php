@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-4">Bonuses</h1>
        <a href="{{ route('bonuses.create') }}" class="btn btn-primary mb-3">Create Bonus</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>User id</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($bonuses as $bonus)
                <tr>
                    <td>{{ $bonus->id }}</td>
                    <td>{{ $bonus->user->id }}</td>
                    <td>{{ $bonus->amount }}</td>
                    <td>
                        <a href="{{ route('bonuses.show', $bonus) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('bonuses.edit', $bonus) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('bonuses.destroy', $bonus) }}" method="POST" class="d-inline"
                              onsubmit="return confirmDelete()">
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

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this bonus? This action cannot be undone.');
        }
    </script>
@endsection
