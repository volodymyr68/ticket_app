@extends('layouts.main')

@section('content')
    <h1>Create New Chat</h1>

    <form action="{{ route('chats.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" id="client_id" class="form-select" required>
                <option value="">Select Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Chat</button>
    </form>
@endsection
