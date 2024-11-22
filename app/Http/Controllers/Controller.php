<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
* @OA\Info(
*     title="API de Gestión de Hoteles",
*     version="1.0.0",
*     description="API para gestionar hoteles, habitaciones, huéspedes y servicios",
* )
*/

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
