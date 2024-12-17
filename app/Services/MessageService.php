<?php

namespace App\Services;

use App\Contracts\Repositories\MessageRepositoryInterface;
use App\Contracts\Services\MessageServiceInterface;

class MessageService extends BaseService implements MessageServiceInterface
{
    public function __construct(
        protected MessageRepositoryInterface $messageRepository
    )
    {
        parent::__construct($messageRepository);
    }
}
