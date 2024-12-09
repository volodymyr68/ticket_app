@extends('layouts.main')

@section('content')
    <h1>Chat #{{ $chat->id }}</h1>

    <div>
        <p><strong>Client:</strong> {{ $chat->client->name ?? 'Unknown' }}</p>
        <p><strong>Manager:</strong> {{ $chat->manager->name ?? 'Not Assigned' }}</p>
    </div>

    <hr>

    <h2>Messages</h2>

    @if($messages->isEmpty())
        <p>No messages in this chat yet.</p>
    @else
        <ul id="messages-list">
            @foreach($messages as $message)
                <li>
                    <p>
                        <strong>{{ $message->sender->name ?? 'Unknown' }}:</strong>
                        {{ $message->message }}
                    </p>
                    <p style="font-size: 0.8em; color: #777;">
                        Sent at: {{ $message->created_at->format('d M Y, H:i') }}
                    </p>
                </li>
            @endforeach
        </ul>
    @endif

    <hr>

    <h3>Add a Message</h3>
    <form action="{{ route('messages.store', $chat->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="3" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>

    <hr>

    <a href="{{ route('chats.index') }}" class="btn btn-secondary">Back to Chats</a>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Initialize Pusher
        var pusher = new Pusher('0c48b8eef40cc5d2451b', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('chat');
        channel.bind('App\\Events\\SendMessageEvent', function(data) {
            console.log(data)
            var message = data.message;
            var messageList = document.getElementById('messages-list');
            var messageItem = document.createElement('li');
            let formatedTime = message.created_at;
            //format('d M Y, H:i')


            messageItem.innerHTML = `<p><strong>{{$chat->client->name }}:</strong> ${message.message}</p><p style="font-size: 0.8em; color: #777;">Sent at: ${}</p>`;
            messageList.appendChild(messageItem);
        });
    </script>
@endsection
