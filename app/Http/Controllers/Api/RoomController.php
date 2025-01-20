<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\PutRequest;
use App\Http\Requests\Room\StoreRequest;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/room",
     *     summary="Obtener lista de habitaciones",
     *     description="Devuelve una lista de habitaciones con la posibilidad de filtrar por número, tipo, precio por noche e id del hotel, y paginar los resultados.",
     *     tags={"Habitaciones"},
     *     @OA\Parameter(
     *         name="number",
     *         in="query",
     *         description="Filtrar por número de la habitación",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Filtrar por el tipo de la habitación",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="nightPrice",
     *         in="query",
     *         description="Filtrar por precio de la habitación",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="hotelId",
     *         in="query",
     *         description="Filtrar por id del hotel",
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
     *     @OA\Response(response=200, description="Lista de habitaciones obtenida"),
     *     @OA\Response(response=400, description="Solicitud incorrecta")
     * )
     */
    public function index(Request $request)
    {
        $number = $request->input('number');
        $type = $request->input('type');
        $nightPrice = $request->input('nightPrice');
        $hotelId = $request->input('hotelId');

        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);

        $query = Room::query();

        if ($number) {
            $query->where('number', 'LIKE', "%{$number}%");
        }
        if ($type) {
            $query->where('type', 'LIKE', "%{$type}%");
        }
        if ($nightPrice) {
            $query->where('nightPrice', 'LIKE', "%{$nightPrice}%");
        }
        if ($hotelId) {
            $query->where('hotelId', 'LIKE', "%{$hotelId}%");
        }

        return response()->json($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
     * @OA\Post(
     *     path="/api/room",
     *     summary="Crear una nueva habitación",
     *     tags={"Habitaciones"},
     *     description="Crea una nueva habitación con los datos introducidos",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos necesarios para crear una habitación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="number", type="string"),
     *             @OA\Property(property="type", type="string"),
     *             @OA\Property(property="nightPrice", type="integer"),
     *             @OA\Property(property="hotelId", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Habitación creada",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Datos inválidos"
     *     )
     * )
     */

    public function store(StoreRequest $request)
    {
        return response()->json(Room::create($request->validated()));
    }

    /**
     * @OA\Get(
     *     path="/api/room/{id}",
     *     summary="Obtener una habitación",
     *     tags={"Habitaciones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la habitación",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Habitación encontrada"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Habitación no encontrada"
     *     )
     * )
     */

    public function show(Room $room)
    {
        return response()->json($room);
    }

    /**
     * @OA\Put(
     *     path="/api/room/{id}",
     *     summary="Actualizar una habitación",
     *     tags={"Habitaciones"},
     *     description="Actualiza una habitación con los datos introducidos",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la habitación a actualizar",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos que se pueden actualizar de la habitación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="number", type="string"),
     *             @OA\Property(property="type", type="string"),
     *             @OA\Property(property="nightPrice", type="integer"),
     *             @OA\Property(property="hotelId", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Habitación actualizada",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Habitación no encontrada"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Solicitud incorrecta"
     *     )
     * )
     */

    public function update(PutRequest $request, Room $room)
    {
        $room->update($request->validated());
        return response()->json($room);
    }

    /**
     * @OA\Delete(
     *     path="/api/room/{id}",
     *     summary="Eliminar una habitación",
     *     tags={"Habitaciones"},
     *     description="Elimina una habitación por su ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la habitación",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Habitación eliminada",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Habitación no encontrada"
     *     )
     * )
     */

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json('OK');
    }

    /**
     * @OA\Get(
     *     path="/api/room/all",
     *     summary="Obtener todas las habitaciones",
     *     tags={"Habitaciones"},
     *     description="Obtener todas las habitaciones sin filtrar ni paginar.",
     *     @OA\Response(response=200, description="Lista de habitaciones obtenida"),
     *     @OA\Response(response=400, description="Solicitud incorrecta")
     * )
     */

    public function getAll()
    {
        return response()->json(Room::all());
    }
}
