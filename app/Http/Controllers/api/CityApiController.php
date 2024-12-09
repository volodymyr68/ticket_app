<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Services\CityService\CityService;
use Illuminate\Http\Request;

class CityApiController extends Controller
{
    /**
     * @var CityService
     */
    protected $cityService;

    public function __construct(CityService $cityService,Request $request)
    {
        if(!$request->expectsJson()){
            abort(406);
        }
        $this->cityService = $cityService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response($this->cityService->getAll(), 200);
    }
}
