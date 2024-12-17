@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Chats</h1>
        <a href="{{ route('chats.create') }}" class="btn btn-primary mb-3">Create New Chat</a>
        @if($chats->isEmpty())
            <p class="text-center">No chats available.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Manager</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($chats as $chat)
                        <tr>
                            <td>{{ $chat->id }}</td>
                            <td>{{ $chat->client->name ?? 'Unknown' }}</td>
                            <td>{{ $chat->manager->name ?? 'Not Assigned' }}</td>
                            <td>
                                <a href="{{ route('chats.show', $chat->id) }}" class="btn btn-primary btn-sm">Show</a>
                                <form action="{{ route('chats.destroy', $chat->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete
                                    </button>
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
