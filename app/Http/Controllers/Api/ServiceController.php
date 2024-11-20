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
     * Display a listing of the resource.
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

    public function all()
    {
        return response()->json(Service::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Service::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Service $service)
    {
        $service->update($request->validated());
        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json('OK');
    }
}
