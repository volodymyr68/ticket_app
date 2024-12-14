<?php

namespace App\Contracts\Services\ChatService;

use App\Contracts\Repositories\ChatRepository\ChatRepository;
use App\Contracts\Services\BaseService;

class ChatService extends BaseService
{
    public function __construct(
        protected ChatRepository $chatRepository
    )
    {
        parent::__construct($chatRepository);
    }

    public function getClientChat()
    {
        return $this->chatRepository->getClientChat();
    }
}
