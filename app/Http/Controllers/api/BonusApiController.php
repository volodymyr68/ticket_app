<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\BonusService\BonusService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BonusApiController extends Controller
{
    /**
     * Constructor for BonusApiController.
     *
     * Initializes the controller with necessary dependencies and checks if the request expects JSON.
     * If the request does not expect JSON, an HTTP 406 Not Acceptable response is sent.
     *
     * @param BonusService $bonusService The service for managing bonuses.
     * @param Request $request The incoming request.
     */
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
     * Displays a listing of the resource.
     *
     * This function retrieves the user's bonus information and returns it as a JSON response.
     * It first authorizes the action using the 'viewAny' policy.
     * Then, it calls the 'getUserBonus' method from the BonusService to fetch the user's bonus data.
     * Finally, it returns the user's bonus data as a JSON response.
     *
     * @return JsonResponse The user's bonus data as a JSON response.
     */
    public function index()
    {
        $this->authorizeAction('viewAny');
        $userBonus = $this->bonusService->getUserBonus();
        return response()->json($userBonus);
    }
}
