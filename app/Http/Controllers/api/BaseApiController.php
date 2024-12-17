<?php

namespace App\Http\Controllers\api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class BaseApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(Request $request)
    {
        if (!$request->expectsJson()) {
            abort(406);
        }
    }

    public function authorizeAction($ability, $model = null)
    {
        if (!$this->authorize($ability, $model ?? auth()->user())) {
            abort(403);
        }
    }
}
