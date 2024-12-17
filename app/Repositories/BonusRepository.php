<?php

namespace App\Repositories;

use App\Contracts\Repositories\BonusRepositoryInterface;
use App\Models\Bonus;

class BonusRepository extends BaseRepository implements BonusRepositoryInterface
{
    public function __construct(Bonus $model)
    {
        parent::__construct($model);
    }

    public function getUserBonus(): Bonus|null
    {
        return auth()->user()->bonus()->first();
    }
}
