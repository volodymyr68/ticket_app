<?php

namespace App\Contracts\Repositories\BonusRepository;

use App\Contracts\Repositories\BaseRepository;
use App\Models\Bonus;

class BonusRepository extends BaseRepository
{
    public function __construct(Bonus $model)
    {
        parent::__construct($model);
    }

    public function getUserBonus(): Bonus
    {
        return auth()->user()->bonus()->first();
    }
}
