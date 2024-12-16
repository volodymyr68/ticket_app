<?php

namespace App\Contracts\Services\MessageService;

use App\Contracts\Repositories\MessageRepository\MessageRepository;
use App\Contracts\Services\BaseService;

class MessageService extends BaseService
{
    public function __construct(
        protected MessageRepository $messageRepository
    )
    {
        parent::__construct($messageRepository);
    }
}
