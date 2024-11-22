<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\PutRequest;
use App\Http\Requests\Hotel\StoreRequest;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/hotel",
    *     summary="Obtener lista de hoteles",
    *     description="Devuelve una lista de hoteles con la posibilidad de filtrar por nombre, dirección, teléfono, email y website, y paginar los resultados.",
    *     tags={"Hoteles"},
    *     @OA\Parameter(
    *         name="name",
    *         in="query",
    *         description="Filtrar por nombre del hotel",
    *         required=false,
    *         @OA\Schema(type="string")
    *     ),
    *     @OA\Parameter(
    *         name="adress",
    *         in="query",
    *         description="Filtrar por dirección del hotel",
    *         required=false,
    *         @OA\Schema(type="string")
    *     ),
    *     @OA\Parameter(
    *         name="phoneNumber",
    *         in="query",
    *         description="Filtrar por número de teléfono del hotel",
    *         required=false,
    *         @OA\Schema(type="string")
    *     ),
    *     @OA\Parameter(
    *         name="email",
    *         in="query",
    *         description="Filtrar por email del hotel",
    *         required=false,
    *         @OA\Schema(type="string")
    *     ),
    *     @OA\Parameter(
    *         name="website",
    *         in="query",
    *         description="Filtrar por sitio web del hotel",
    *         required=false,
    *         @OA\Schema(type="string")
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
    *     @OA\Response(response=200, description="Lista de hoteles obtenida"),
    *     @OA\Response(response=400, description="Solicitud incorrecta")
    * )
    */
    public function index(Request $request)
    {
        $name = $request->input('name');
        $adress = $request->input('adress');
        $phoneNumber = $request->input('phoneNumber');
        $email = $request->input('email');
        $website = $request->input('website');

        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);

        $query = Hotel::query();

        if($name){
            $query->where('name', 'LIKE', "%{$name}%");
        }
        if($adress){
            $query->where('adress', 'LIKE', "%{$adress}%");
        }
        if($phoneNumber){
            $query->where('phoneNumber', 'LIKE', "%{$phoneNumber}%");
        }
        if($email){
            $query->where('email', 'LIKE', "%{$email}%");
        }
        if($website){
            $query->where('website', 'LIKE', "%{$website}%");
        }

        return response()->json($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
    * @OA\Post(
    *     path="/api/hotel",
    *     summary="Crear un nuevo hotel",
    *     tags={"Hoteles"},
    *     description="Crea un nuevo hotel con los datos introducidos",
    *     @OA\RequestBody(
    *         required=true,
    *         description="Datos necesarios para crear un hotel",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="name", type="string"),
    *             @OA\Property(property="adress", type="string"),
    *             @OA\Property(property="phoneNumber", type="string"),
    *             @OA\Property(property="email", type="string"),
    *             @OA\Property(property="website", type="string"),
    *             @OA\Property(
    *               property="services",
    *               type="array",
    *               @OA\Items(
    *               type="integer"
    *               )
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Hotel creado",
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Datos inválidos"
    *     )
    * )
    */

    public function store(StoreRequest $request)
    {
        $hotel = Hotel::create($request->validated());
        if ($request->has('services')) {
            $hotel->services()->attach($request->services);
        }
        return response()->json($hotel);
    }

    /**
    * @OA\Get(
    *     path="/api/hotel/{id}",
    *     summary="Obtener un hotel",
    *     tags={"Hoteles"},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del hotel",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Hotel encontrado"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Hotel no encontrado"
    *     )
    * )
    */

    public function show(Hotel $hotel)
    {
        $hotel = $hotel->load('services');
        return response()->json($hotel);
    }

    /**
    * @OA\Put(
    *     path="/api/hotel/{id}",
    *     summary="Actualizar un hotel",
    *     tags={"Hoteles"},
    *     description="Actualiza un hotel con los datos introducidos",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del hotel a actualizar",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         description="Datos que se pueden actualizar del hotel",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="name", type="string"),
    *             @OA\Property(property="adress", type="string"),
    *             @OA\Property(property="phoneNumber", type="string"),
    *             @OA\Property(property="email", type="string"),
    *             @OA\Property(property="website", type="string"),
    *             @OA\Property(
    *               property="services",
    *               type="array",
    *               @OA\Items(
    *               type="integer"
    *               )
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Hotel actualizado",
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Hotel no encontrado"
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Solicitud incorrecta"
    *     )
    * )
    */

    public function update(PutRequest $request, Hotel $hotel)
    {
        $hotel->update($request->validated());
        if ($request->has('services')) {
            $hotel->services()->sync($request->services);
        }
        return response()->json($hotel);
    }

    /**
    * @OA\Delete(
    *     path="/api/hotel/{id}",
    *     summary="Eliminar un hotel",
    *     tags={"Hoteles"},
    *     description="Elimina un hotel por su ID.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del hotel",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Hotel eliminado",
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Hotel no encontrado"
    *     )
    * )
    */

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return response()->json('OK');
    }
}
