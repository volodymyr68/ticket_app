<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\CityService\CityService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CityApiController extends Controller
{
    /**
     * CityApiController constructor.
     *
     * Initializes the controller with necessary dependencies and checks if the request expects JSON.
     * If the request does not expect JSON, an HTTP 406 Not Acceptable response is sent.
     *
     * @param CityService $cityService The service for managing cities.
     * @param Request $request The incoming request.
     */
    public function __construct(
        protected CityService $cityService,
        Request               $request
    )
    {
        if (!$request->expectsJson()) {
            abort(406);
        }
    }


    /**
     * Retrieves a list of cities.
     *
     * This function is responsible for handling the retrieval of all cities from the application.
     * It first authorizes the current user to perform the 'viewAny' action on the 'City' model.
     * Then, it retrieves all cities using the injected CityService and returns them as a JSON response with a HTTP 200 status code.
     *
     * @return JsonResponse The JSON response containing the list of cities.
     */
    public function index()
    {
        $this->authorizeAction('viewAny');
        return response($this->cityService->getAll(), 200);
    }
}
