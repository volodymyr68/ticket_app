<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CityService\CityService;
use App\Contracts\Services\VehicleService\VehicleService;
use App\Http\Requests\VehicleCreateRequest;
use App\Jobs\GenerateVehiclePdf;
use App\Models\City;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{


    public function __construct(
        protected VehicleService $vehicleService,
        protected CityService    $cityService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['quality', 'departure_city_id', 'destination_city_id', 'ticket_cost', 'seats_quantity']);

        $vehicles = $this->vehicleService->getSortedVehicles($filters, 10);
        $cities = City::all();

        return view('vehicles.index', compact('vehicles', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleCreateRequest $request)
    {
//        if(!$this->authorize('create', Vehicle::class)){
//            abort(403);
//        }
        $vehicle = $this->vehicleService->create($request->all());
        return redirect()->route('vehicle.show', [$vehicle]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        if(!$this->authorize('create', Vehicle::class)){
//            abort(403);
//        }
        $cities = $this->cityService->getAll();
        return view('vehicles.create', ["cities" => $cities]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Vehicle $vehicle)
    {
//        if(!$this->authorize('view', $vehicle)){
//            abort(403);
//
        return view('vehicles.show', ['vehicle' => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
//        if(!$this->authorize('update', $vehicle)){
//            abort(403);
//        }
        $cities = $this->cityService->getAll();
        return view('vehicles.edit', ['vehicle' => $vehicle, 'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleCreateRequest $request, Vehicle $vehicle)
    {
//        if(!$this->authorize('update', $vehicle)){
//            abort(403);
//        }
        $vehicle = $this->vehicleService->update($vehicle, $request->all());
        return redirect()->route('vehicle.show', [$vehicle]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicle.index');
    }

    public function exportVehicles(Request $request)
    {
        $vehicles = $this->vehicleService->getAllPaginated(10);
        GenerateVehiclePdf::dispatch($vehicles);
    }
}
