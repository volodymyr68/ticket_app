<?php

namespace App\Contracts\Repositories\ChatRepository;

use App\Contracts\Repositories\BaseRepository;
use App\Models\Chat;

class ChatRepository extends BaseRepository implements ChatRepositoryInterface
{
    public function __construct(Chat $model)
    {
        parent::__construct($model);
    }

    public function getClientChat(): Chat
    {
        $chat = Chat::where('client_id', auth()->user()->id)->first();
        if (!$chat || $chat->count() === 0) {
            $chat = new Chat(['client_id' => auth()->user()->id, 'manager_id' => 2]);
            $chat->save();
        }
        return $chat;
    }
}
