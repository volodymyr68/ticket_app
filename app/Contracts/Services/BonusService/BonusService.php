<?php

namespace App\Contracts\Services\BonusService;

use App\Contracts\Repositories\BonusRepository\BonusRepository;
use App\Contracts\Services\BaseService;

class BonusService extends BaseService
{
    public function __construct(
        protected BonusRepository $bonusRepository
    )
    {
        parent::__construct($bonusRepository);
    }

    function getUserBonus()
    {
        $userBonus = $this->bonusRepository->getUserBonus();

        if (!$userBonus) {
            $data = [
                'amount' => 0,
                'user_id' => auth()->user()->id
            ];
            return $this->bonusRepository->create($data);
        }

        return $userBonus;
    }
}
