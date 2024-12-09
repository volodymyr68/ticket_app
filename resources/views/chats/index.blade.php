@extends('layouts.main')

@section('content')
    <h1>Chats</h1>

    <!-- Button to create a new chat -->
    <div style="margin-bottom: 20px;">
        <a href="{{ route('chats.create') }}" class="btn btn-success">Create New Chat</a>
    </div>

    @if($chats->isEmpty())
        <p>No chats available.</p>
    @else
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">ID</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Client</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Manager</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($chats as $chat)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $chat->id }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $chat->client->name ?? 'Unknown' }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">{{ $chat->manager->name ?? 'Not Assigned' }}</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">
                        <!-- Button to view chat -->
                        <a href="{{ route('chats.show', $chat->id) }}" class="btn btn-primary" style="margin-right: 10px;">Show</a>

                        <!-- Button to delete chat -->
                        <form action="{{ route('chats.destroy', $chat->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
