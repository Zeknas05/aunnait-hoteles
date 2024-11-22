<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\PutRequest;
use App\Http\Requests\Guest\StoreRequest;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/guest",
    *     summary="Obtener lista de huéspedes",
    *     description="Devuelve una lista de huéspedes con la posibilidad de filtrar por nombre, apellido, pasaporte o DNI, fecha de entrada, fecha de salida e id de la habitación, y paginar los resultados.",
    *     tags={"Huéspedes"},
        *     @OA\Parameter(
    *         name="name",
    *         in="query",
    *         description="Filtrar por nombre del huésped",
    *         required=false,
    *         @OA\Schema(type="string")
    *     ),
    *     @OA\Parameter(
    *         name="surname",
    *         in="query",
    *         description="Filtrar por apellido del huésped",
    *         required=false,
    *         @OA\Schema(type="string")
    *     ),
    *     @OA\Parameter(
    *         name="passportID",
    *         in="query",
    *         description="Filtrar por DNI o pasaporte del huésped",
    *         required=false,
    *         @OA\Schema(type="string")
    *     ),
    *     @OA\Parameter(
    *         name="checkinDate",
    *         in="query",
    *         description="Filtrar por fecha de entrada del huésped",
    *         required=false,
    *         @OA\Schema(type="date")
    *     ),
    *     @OA\Parameter(
    *         name="checkoutDate",
    *         in="query",
    *         description="Filtrar por fecha de salida del huésped",
    *         required=false,
    *         @OA\Schema(type="date")
    *     ),
        *     @OA\Parameter(
    *         name="roomId",
    *         in="query",
    *         description="Filtrar por id de la habitación",
    *         required=false,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Parameter(
    *         name="page",
    *         in="query",
    *         description="Número de página",
    *         required=false,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Parameter(
    *         name="per_page",
    *         in="query",
    *         description="Número de elementos por página",
    *         required=false,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(response=200, description="Lista de huéspedes obtenida"),
    *     @OA\Response(response=400, description="Solicitud incorrecta")
    * )
    */
    public function index(Request $request)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $passportID = $request->input('passportID');
        $checkinDate = $request->input('checkinDate');
        $checkoutDate = $request->input('checkoutDate');
        $roomId = $request->input('roomId');

        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);

        $query = Guest::query();

        if($name){
            $query->where('name', 'LIKE', "%{$name}%");
        }
        if($surname){
            $query->where('surname', 'LIKE', "%{$surname}%");
        }
        if($passportID){
            $query->where('passportID', 'LIKE', "%{$passportID}%");
        }
        if($checkinDate){
            $query->where('checkinDate', 'LIKE', "%{$checkinDate}%");
        }
        if($checkoutDate){
            $query->where('checkoutDate', 'LIKE', "%{$checkoutDate}%");
        }
        if($roomId){
            $query->where('roomId', 'LIKE', "%{$roomId}%");
        }

        return response()->json($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
    * @OA\Post(
    *     path="/api/guest",
    *     summary="Crear un nuevo huésped",
    *     tags={"Huéspedes"},
    *     description="Crea un nuevo huésped con los datos introducidos",
    *     @OA\RequestBody(
    *         required=true,
    *         description="Datos necesarios para crear un huésped",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="name", type="string"),
    *             @OA\Property(property="surname", type="string"),
    *             @OA\Property(property="passportID", type="string"),
    *             @OA\Property(property="checkinDate", type="date"),
    *             @OA\Property(property="checkoutDate", type="date"),
    *             @OA\Property(property="roomId", type="integer")
    *         )
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Huésped creado",
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Datos inválidos"
    *     )
    * )
    */

    public function store(StoreRequest $request)
    {
        return response()->json(Guest::create($request->validated()));
    }

    /**
    * @OA\Get(
    *     path="/api/guest/{id}",
    *     summary="Obtener un huésped",
    *     tags={"Huéspedes"},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del huésped",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Huésped encontrado"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Huésped no encontrado"
    *     )
    * )
    */

    public function show(Guest $guest)
    {
        return response()->json($guest);
    }

   /**
    * @OA\Put(
    *     path="/api/guest/{id}",
    *     summary="Actualizar un huésped",
    *     tags={"Huéspedes"},
    *     description="Actualiza un huésped con los datos introducidos",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del huésped a actualizar",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         description="Datos que se pueden actualizar del huésped",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="name", type="string"),
    *             @OA\Property(property="surname", type="string"),
    *             @OA\Property(property="passportID", type="string"),
    *             @OA\Property(property="checkinDate", type="date"),
    *             @OA\Property(property="checkoutDate", type="date"),
    *             @OA\Property(property="roomId", type="integer")
    *         )
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Huésped actualizado",
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Huésped no encontrado"
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Solicitud incorrecta"
    *     )
    * )
    */

    public function update(PutRequest $request, Guest $guest)
    {
        $guest->update($request->validated());
        return response()->json($guest);
    }

    /**
    * @OA\Delete(
    *     path="/api/guest/{id}",
    *     summary="Eliminar un huésped",
    *     tags={"Huéspedes"},
    *     description="Elimina un huésped por su ID.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del huésped",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Huésped eliminado",
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Huésped no encontrado"
    *     )
    * )
    */

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json('OK');
    }
}
