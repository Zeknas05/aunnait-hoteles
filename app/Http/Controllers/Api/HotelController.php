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
    
    public function all()
    {
        return response()->json(Hotel::get());
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        $hotel = $hotel->load('services');
        return response()->json($hotel);
    }

    /**
     * Update the specified resource in storage.
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
        ->where('hotelId', $hotel->id)
        ->get();
        return response()->json($rooms);
    }
}
