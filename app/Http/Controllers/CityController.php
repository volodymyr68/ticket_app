<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CityService\CityService;
use App\Http\Requests\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CityController extends Controller
{

    public function __construct(protected CityService $cityService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
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
     *
     * @param CityRequest $request
     * @return RedirectResponse
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
     *
     * @return View
     */
    public function create()
    {
        $this->authorizeAction('create');
        return view('cities.create');
    }

    /**
     * Display the specified resource.
     *
     * @param City $city
     * @return View
     */
    public function show(City $city)
    {
        $this->authorizeAction('view');
        return view('cities.show', ['city' => $city]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param City $city
     * @return View
     */
    public function edit(City $city)
    {
        $this->authorizeAction('update');
        return view('cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CityRequest $request
     * @param City $city
     * @return RedirectResponse
     */
    public function update(CityRequest $request, City $city)
    {
        $this->authorizeAction('update');
        $updatedCity = $this->cityService->update($city, $request->all());
        return redirect()->route('cities.show', $updatedCity)->with('success', 'City updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     * @return RedirectResponse
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index');
    }
}
