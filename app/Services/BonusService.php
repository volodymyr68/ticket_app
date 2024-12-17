<?php

namespace App\Services;

use App\Contracts\Repositories\BonusRepositoryInterface;
use App\Contracts\Services\BonusServiceInterface;
use App\Models\Bonus;

class BonusService extends BaseService implements BonusServiceInterface
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
