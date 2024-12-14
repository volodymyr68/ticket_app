<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function authorizeAction($ability, $model = null)
    {
        if (!$this->authorize($ability, $model ?? auth()->user())) {
            abort(403);
        }
    }
}
