<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\PutRequest;
use App\Http\Requests\Hotel\StoreRequest;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Hotel::paginate(2);
        return response()->json(Hotel::paginate(5));
    }
    
    public function all()
    {
        return response()->json(Hotel::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Hotel::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return response()->json($hotel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Hotel $hotel)
    {
        $hotel->update($request->validated());
        return response()->json($hotel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return response()->json('OK');
    }

    public function rooms(Hotel $hotel)
    {
        $rooms = Room::with('hotel')
        ->where('hotel_id', $hotel->id)
        ->get();
        return response()->json($rooms);
    }
}
