<?php

namespace App\Services;

use App\Contracts\Repositories\ChatRepositoryInterface;
use App\Contracts\Services\BaseService;
use App\Contracts\Services\ChatServiceInterface;
use App\Models\Chat;

class ChatService extends BaseService implements ChatServiceInterface
{
    public function __construct(
        protected ChatRepositoryInterface $chatRepository
    )
    {
        parent::__construct($chatRepository);
    }

    public function getClientChat(): Chat
    {
        $chat = $this->chatRepository->getClientChat();
        if (!$chat || $chat->count() === 0) {
            $chat = $this->chatRepository->create(['client_id' => auth()->user()->id, 'manager_id' => 2]);
        }
        return $chat;
    }
}
