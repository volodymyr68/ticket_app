<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CityServiceInterface;
use App\Contracts\Services\VehicleServiceInterface;
use App\Http\Requests\VehicleCreateRequest;
use App\Jobs\GenerateVehiclePdf;
use App\Models\City;
use App\Models\Vehicle;
use App\Services\CityService;
use App\Services\VehicleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{

    /**
     * Constructor for VehicleController.
     *
     * @param VehicleService $vehicleService The service for managing vehicles.
     * @param CityService $cityService The service for managing cities.
     */
    public function __construct(
        protected VehicleServiceInterface $vehicleService,
        protected CityServiceInterface    $cityService
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request The incoming request.
     *
     * @return View The view for displaying the vehicles.
     */
    public function index(Request $request)
    {
        $this->authorizeAction('viewAny');
        $filters = $request->only(['quality', 'departure_city_id', 'destination_city_id', 'ticket_cost', 'seats_quantity']);

        $vehicles = $this->vehicleService->getSortedVehicles($filters);
        $cities = City::all();

        return view('vehicles.index', compact('vehicles', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleCreateRequest $request The incoming request.
     *
     * @return RedirectResponse Redirect to the vehicle's show page.
     */
    public function store(VehicleCreateRequest $request)
    {
        $this->authorizeAction('create');
        $vehicle = $this->vehicleService->create($request->all());
        return redirect()->route('vehicle.show', [$vehicle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View The view for creating a new vehicle.
     */
    public function create()
    {
        $this->authorizeAction('create');
        $cities = $this->cityService->getAll();
        return view('vehicles.create', ["cities" => $cities]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request The incoming request.
     * @param Vehicle $vehicle The vehicle to be displayed.
     *
     * @return View The view for displaying the vehicle.
     */
    public function show(Request $request, Vehicle $vehicle)
    {
        $this->authorizeAction('view');
        return view('vehicles.show', ['vehicle' => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Vehicle $vehicle The vehicle to be edited.
     *
     * @return View The view for editing the vehicle.
     */
    public function edit(Vehicle $vehicle)
    {
        $this->authorizeAction('update');
        $cities = $this->cityService->getAll();
        return view('vehicles.edit', ['vehicle' => $vehicle, 'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehicleCreateRequest $request The incoming request.
     * @param Vehicle $vehicle The vehicle to be updated.
     *
     * @return RedirectResponse Redirect to the vehicle's show page.
     */
    public function update(VehicleCreateRequest $request, Vehicle $vehicle)
    {
        $this->authorizeAction('update');
        $vehicle = $this->vehicleService->update($vehicle, $request->all());
        return redirect()->route('vehicle.show', [$vehicle]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vehicle $vehicle The vehicle to be deleted.
     *
     * @return RedirectResponse Redirect to the vehicles index page.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicle.index');
    }

    /**
     * Export vehicles to a PDF file.
     *
     */
    public function exportVehicles(Request $request)
    {
        $filters = $request->only(['quality', 'departure_city_id', 'destination_city_id', 'ticket_cost', 'seats_quantity']);

        $vehicles = $this->vehicleService->getSortedVehicles($filters);

        GenerateVehiclePdf::dispatch($vehicles);

        return response()->json(['success' => true]);
    }
}
