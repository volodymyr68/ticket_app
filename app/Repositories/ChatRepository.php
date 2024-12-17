<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepository;
use App\Contracts\Repositories\ChatRepositoryInterface;
use App\Models\Chat;

class ChatRepository extends BaseRepository implements ChatRepositoryInterface
{
    public function __construct(Chat $model)
    {
        parent::__construct($model);
    }

    public function getClientChat(): Chat
    {
        return Chat::where('client_id', auth()->user()->id)->first();
    }
}
