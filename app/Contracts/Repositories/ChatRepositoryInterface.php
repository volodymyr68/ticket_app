<?php

namespace App\Contracts\Repositories;

use App\Models\Chat;

interface ChatRepositoryInterface
{
    public function getClientChat(): Chat;
}
