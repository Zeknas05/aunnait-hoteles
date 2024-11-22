<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\PutRequest;
use App\Http\Requests\Service\StoreRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/service",
    *     summary="Obtener lista de servicios",
    *     description="Devuelve una lista de servicios con la posibilidad de filtrar por nombre y descripción, y paginar los resultados.",
    *     tags={"Servicios"},
    *     @OA\Parameter(
    *         name="name",
    *         in="query",
    *         description="Filtrar por nombre del servicio",
    *         required=false,
    *         @OA\Schema(type="string")
    *     ),
    *     @OA\Parameter(
    *         name="description",
    *         in="query",
    *         description="Filtrar por descripción del servicio",
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
    *     @OA\Response(response=200, description="Lista de servicios obtenida"),
    *     @OA\Response(response=400, description="Solicitud incorrecta")
    * )
    */
    public function index(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);

        $query = Service::query();

        if($name){
            $query->where('name', 'LIKE', "%{$name}%");
        }
        if($description){
            $query->where('surname', 'LIKE', "%{$description}%");
        }

        return response()->json($query->paginate($perPage, ['*'], 'page', $page));
    }

    /**
    * @OA\Post(
    *     path="/api/service",
    *     summary="Crear un nuevo servicio",
    *     tags={"Servicios"},
    *     description="Crea un nuevo huésped con los datos introducidos",
    *     @OA\RequestBody(
    *         required=true,
    *         description="Datos necesarios para crear un servicio",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="name", type="string"),
    *             @OA\Property(property="description", type="string"),
    *         )
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Servicio creado",
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Datos inválidos"
    *     )
    * )
    */
    public function store(StoreRequest $request)
    {
        return response()->json(Service::create($request->validated()));
    }

    /**
    * @OA\Get(
    *     path="/api/service/{id}",
    *     summary="Obtener un servicio",
    *     tags={"Servicios"},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del servicio",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Servicio encontrado"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Servicio no encontrado"
    *     )
    * )
    */

    public function show(Service $service)
    {
        return response()->json($service);
    }

   /**
    * @OA\Put(
    *     path="/api/services/{id}",
    *     summary="Actualizar un servicio",
    *     tags={"Servicios"},
    *     description="Actualiza un servicio con los datos introducidos",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del servicio a actualizar",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         description="Datos que se pueden actualizar del servicio",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="name", type="string"),
    *             @OA\Property(property="description", type="string"),
    *         )
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Servicio actualizado",
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Servicio no encontrado"
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Solicitud incorrecta"
    *     )
    * )
    */

    public function update(PutRequest $request, Service $service)
    {
        $service->update($request->validated());
        return response()->json($service);
    }

    /**
    * @OA\Delete(
    *     path="/api/service/{id}",
    *     summary="Eliminar un servicio",
    *     tags={"Servicios"},
    *     description="Elimina un servicio por su ID.",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del servicio",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Servicio eliminado",
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Servicio no encontrado"
    *     )
    * )
    */

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json('OK');
    }
}
