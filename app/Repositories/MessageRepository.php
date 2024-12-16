<?php

namespace App\Contracts\Repositories\MessageRepository;

use App\Contracts\Repositories\BaseRepository;
use App\Models\Message;

class MessageRepository extends BaseRepository
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }
}
