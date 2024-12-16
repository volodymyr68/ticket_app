@extends('layouts.main')

@section('content')
    <h1>Chat #{{ $chat->id }}</h1>

    <div>
        <p><strong>Client:</strong> {{ $chat->client->name ?? 'Unknown' }}</p>
        <p><strong>Manager:</strong> {{ $chat->manager->name ?? 'Not Assigned' }}</p>
    </div>

    <hr>

    <h2>Messages</h2>

    <div id="chat-container"
         style="border: 1px solid #ccc; padding: 10px; height: 300px; overflow-y: auto; background-color: #f9f9f9;">
        @if($messages->isEmpty())
            <p>No messages in this chat yet.</p>
        @else
            <ul id="messages-list" style="list-style: none; padding: 0;">
                @foreach($messages as $message)
                    <li class="message-item" style="display: flex; margin-bottom: 10px;">
                        <div
                            style="flex: 1; {{ $message->sender_id == $chat->client_id ? 'text-align: left;' : 'text-align: right;' }}">
                            <div
                                style="display: inline-block; max-width: 60%; padding: 10px; border-radius: 10px; {{ $message->sender_id == $chat->client_id ? 'background-color: #d1e7dd;' : 'background-color: #f8d7da;' }}">
                                <p style="margin: 0;"><strong>{{ $message->sender->name ?? 'Unknown' }}:</strong></p>
                                <p style="margin: 0;">{{ $message->message }}</p>
                                <p style="font-size: 0.8em; color: #777; margin: 5px 0 0;">
                                    {{ $message->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

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
        const pusher = new Pusher('0c48b8eef40cc5d2451b', {
            cluster: 'eu'
        });

        const channel = pusher.subscribe('chat.5');
        channel.bind('App\\Events\\SendMessageEvent', function (data) {
            const message = data.message;
            const messageList = document.getElementById('messages-list');
            const messageItem = document.createElement('li');
            messageItem.classList.add('message-item');
            messageItem.style.display = "flex";
            messageItem.style.marginBottom = "10px";

            const alignment = message.sender_id == {{ $chat->client->id }} ? 'left' : 'right';
            const bgColor = alignment === 'left' ? '#d1e7dd' : '#f8d7da';

            const createdAt = new Date(message.created_at);
            const formattedDate = createdAt.toLocaleString('en-US', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });

            messageItem.innerHTML = `
        <div style="flex: 1; text-align: ${alignment};">
            <div style="display: inline-block; max-width: 60%; padding: 10px; border-radius: 10px; background-color: ${bgColor};">
                <p style="margin: 0;"><strong>${message.sender_id == {{ $chat->client->id }} ? '{{ $chat->client->name }}' : 'Manager'}:</strong></p>
                <p style="margin: 0;">${message.message}</p>
                <p style="font-size: 0.8em; color: #777; margin: 5px 0 0;">
                    ${formattedDate}
                </p>
            </div>
        </div>
    `;

            messageList.appendChild(messageItem);

            scrollToBottom();
        });

        function scrollToBottom() {
            const chatContainer = document.getElementById('chat-container');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        document.addEventListener('DOMContentLoaded', function () {
            scrollToBottom();
        });
    </script>
@endsection
