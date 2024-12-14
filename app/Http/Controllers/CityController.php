<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CityService\CityService;
use App\Http\Requests\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * @var CityService
     */

    public function __construct(protected CityService $cityService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorizeAction('viewAny');
        $filter = $request->input('filter', '');
        $cities = $this->cityService->getFilteredCities($filter);
        return view('cities.index', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $this->authorizeAction('create');
        $data = $request->except('_token');
        $city = $this->cityService->create($data);
        return redirect()->route('cities.show', [$city]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorizeAction('create');
        return view('cities.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        $this->authorizeAction('view');
        return view('cities.show', ['city' => $city]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $this->authorizeAction('update');
        return view('cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        $this->authorizeAction('update');
        $updatedCity = $this->cityService->update($city, $request->all());
        return redirect()->route('cities.show', $updatedCity)->with('success', 'City updated successfully!');
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
