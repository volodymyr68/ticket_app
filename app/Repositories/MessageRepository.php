<?php

namespace App\Repositories;

use App\Contracts\Repositories\MessageRepositoryInterface;
use App\Models\Message;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }
}
