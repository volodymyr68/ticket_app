<?php

namespace App\Contracts\Services\BonusService;

use App\Contracts\Repositories\BonusRepositoryInterface;
use App\Contracts\Services\BaseService;
use App\Models\Bonus;

class BonusService extends BaseService
{
    public function __construct(
        protected BonusRepositoryInterface $bonusRepository
    )
    {
        parent::__construct($bonusRepository);
    }

    function getUserBonus(): Bonus
    {
        return $this->bonusRepository->getUserBonus();
    }
}
