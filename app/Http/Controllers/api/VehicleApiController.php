<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\VehicleService\VehicleService;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleCollection;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleApiController extends Controller
{

    /**
     * VehicleApiController constructor.
     *
     * Initializes the VehicleApiController with the provided VehicleService and Request instances.
     * If the Request does not expect a JSON response, an HTTP 406 Not Acceptable response is sent.
     *
     * @param VehicleService $vehicleService The service for managing vehicles.
     * @param Request $request The HTTP request.
     */
    public function __construct(
        protected VehicleService $vehicleService,
        Request                  $request)
    {
        if (!$request->expectsJson()) {
            abort(406);
        }
    }


    /**
     * Retrieves a paginated list of vehicles based on the provided filters.
     *
     * @param Request $request The HTTP request containing the filtering parameters.
     *
     * @return VehicleCollection A collection of VehicleResource instances.
     *
     * @throws AuthorizationException If the user is not authorized to view any vehicles.
     */
    public function index(Request $request)
    {
        $this->authorizeAction('viewAny');
        $filters = $request->only([
            'departure_city_id',
            'destination_city_id',
            'seats_quantity',
            'departure_time',
            'price_range',
            'quality',
            'sort_by_time'
        ]);

        $vehicles = $this->vehicleService->getFilteredVehicles($filters);
        return new VehicleCollection($vehicles);
    }


    /**
     * Retrieves a single vehicle by its ID.
     *
     * This function retrieves a vehicle from the database based on the provided Vehicle model instance.
     * It then authorizes the current user to view the vehicle.
     * Finally, it returns a VehicleResource instance representing the vehicle.
     *
     * @param Vehicle $vehicle The Vehicle model instance representing the vehicle to retrieve.
     *
     * @return JsonResource A VehicleResource instance representing the vehicle.
     *
     * @throws AuthorizationException If the user is not authorized to view the vehicle.
     */
    public function show(Vehicle $vehicle)
    {
        $this->authorizeAction('view');
        return new VehicleResource($vehicle);
    }

}
