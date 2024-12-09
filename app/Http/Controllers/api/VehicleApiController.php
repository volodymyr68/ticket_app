<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleCollection;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use App\Services\VehicleService\VehicleService;
use Illuminate\Http\Request;

class VehicleApiController extends Controller
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService, Request $request)
    {
        if(!$request->expectsJson()) {
            abort(406);
        }
        $this->vehicleService = $vehicleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
//        if(!$this->authorize('view', $vehicle)){
//            abort(403);
//        }
        return new VehicleResource($vehicle);
    }


}
