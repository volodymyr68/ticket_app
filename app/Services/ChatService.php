<?php

namespace App\Contracts\Services\ChatService;

use App\Contracts\Repositories\ChatRepositoryInterface;
use App\Contracts\Services\BaseService;
use App\Models\Chat;
use App\Repositories\ChatRepository;

class ChatService extends BaseService
{
    public function __construct(
        protected ChatRepositoryInterface $chatRepository
    )
    {
        parent::__construct($chatRepository);
    }

    public function getClientChat(): Chat
    {
        return $this->chatRepository->getClientChat();
    }
}
