<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\CityService\CityService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityApiController extends Controller
{
    /**
     * @var CityService
     */
    protected $cityService;

    public function __construct(CityService $cityService, Request $request)
    {
        if (!$request->expectsJson()) {
            abort(406);
        }
        $this->cityService = $cityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorizeAction('viewAny');
        return response($this->cityService->getAll(), 200);
    }
}
