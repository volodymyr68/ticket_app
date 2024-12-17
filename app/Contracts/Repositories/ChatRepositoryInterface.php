<?php

namespace App\Contracts\Repositories;

use App\Models\Chat;

interface ChatRepositoryInterface extends BaseRepositoryInterface
{
    public function getClientChat(): Chat;
}
