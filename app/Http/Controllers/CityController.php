<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Services\CityService\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * @var CityService
     */
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
//        $cities = $this->cityService->getAllPaginated(8);
//        $cities = City::sortable()->paginate(5);
        $filter = $request->input('filter', '');
        $cities = City::sortable()
            ->where('name', 'like', '%' . $filter . '%')  // If you are filtering by name
            ->paginate(5);
        return view('cities.index')->with('cities', $cities);
//        return view('cities.index',['cities'=>$cities]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!$this->authorize('create', City::class)){
            abort(403);
        }
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        if(!$this->authorize('create', City::class)){
            abort(403);
        }
        $data = $request->except('_token');
        $city = $this->cityService->create($data);
        return redirect()->route('cities.show',[$city]);
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        if(!$this->authorize('view', $city)){
            abort(403);
        }
        return view('cities.show', ['city' => $city]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        if(!$this->authorize('update', $city)){
            abort(403);
        }
        return view('cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        if(!$this->authorize('update', $city)){
            abort(403);
        }
        $data = $request->except('_token');
        $updateResult = $this->cityService->update($city,$data);
        if ($updateResult) {
            return redirect()->route('cities.show', $city)->with('success', 'City updated successfully!');
        }
        return back()->with('error', 'Failed to update the city.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index');
    }
}
