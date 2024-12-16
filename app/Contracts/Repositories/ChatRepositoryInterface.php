<?php

namespace App\Contracts\Repositories\ChatRepository;

use App\Models\Chat;

interface ChatRepositoryInterface
{
    public function getClientChat(): Chat;
}
