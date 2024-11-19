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
     * Display a listing of the resource.
     */
    public function index()
    {
        Guest::paginate(2);
        return response()->json(Guest::paginate(5));
    }

    public function all()
    {
        return response()->json(Guest::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Guest::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return response()->json($guest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Guest $guest)
    {
        $guest->update($request->validated());
        return response()->json($guest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json('OK');
    }
}
