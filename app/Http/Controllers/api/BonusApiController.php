<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\BonusService\BonusService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BonusApiController extends Controller
{
    public function __construct(
        protected BonusService $bonusService,
        Request                $request
    )
    {
        if (!$request->expectsJson()) {
            abort(406);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userBonus = $this->bonusService->getUserBonus();
        return response()->json($userBonus);
    }

}
