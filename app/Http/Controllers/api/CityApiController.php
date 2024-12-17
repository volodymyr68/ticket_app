<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\CityServiceInterface;
use App\Http\Controllers\Controller;
use App\Services\CityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityApiController extends BaseApiController
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
        protected CityServiceInterface $cityService,
        Request                        $request
    )
    {
        parent::__construct($request);
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
