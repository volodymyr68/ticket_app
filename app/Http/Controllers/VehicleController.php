<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleCreateRequest;
use App\Http\Resources\VehicleResource;
use App\Jobs\GenerateVehiclePdf;
use App\Models\City;
use App\Models\Vehicle;
use App\Services\CityService\CityService;
use App\Services\VehicleService\VehicleService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    protected $vehicleService;
    protected $cityService;

    public function __construct(VehicleService $vehicleService, CityService $cityService)
    {
        $this->vehicleService = $vehicleService;
        $this->cityService = $cityService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Vehicle::query();

        if ($request->has('quality') && $request->quality) {
            $query->where('quality', 'like', '%' . $request->quality . '%');
        }

        if ($request->has('departure_city_id') && $request->departure_city_id) {
            $query->where('departure_city_id', $request->departure_city_id);
        }

        if ($request->has('destination_city_id') && $request->destination_city_id) {
            $query->where('destination_city_id', $request->destination_city_id);
        }

        if ($request->has('ticket_cost') && $request->ticket_cost) {
            $query->where('ticket_cost', '<=', $request->ticket_cost);
        }

        if ($request->has('seats_quantity') && $request->seats_quantity) {
            $query->where('seats_quantity', '>=', $request->seats_quantity);
        }

        $vehicles = $query->sortable()->paginate(10);
        $cities = City::all();

        return view('vehicles.index', compact('vehicles', 'cities'));
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
        return view('vehicles.create',["cities"=> $cities ]);
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
        return redirect()->route('vehicle.show',[$vehicle]);
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
        $vehicle = $this->vehicleService->update($vehicle,$request->all());
        return redirect()->route('vehicle.show',[$vehicle]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicle.index');
    }

    public function exportVehicles()
    {
        $vehicles = $this->vehicleService->getAllPaginated(8);
//        $pdf = PDF::loadView('pdfs.vehicles', ['vehicles' => $vehicles]);
//        return $pdf->download('document.pdf');
        GenerateVehiclePdf::dispatch($vehicles);
    }
}
