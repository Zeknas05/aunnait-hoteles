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
     * Display a listing of the resource.
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

        if($number){
            $query->where('number', 'LIKE', "%{$number}%");
        }
        if($type){
            $query->where('type', 'LIKE', "%{$type}%");
        }
        if($nightPrice){
            $query->where('nightPrice', 'LIKE', "%{$nightPrice}%");
        }
        if($hotelId){
            $query->where('hotelId', 'LIKE', "%{$hotelId}%");
        }

        return response()->json($query->paginate($perPage, ['*'], 'page', $page));
    }

    public function all()
    {
        return response()->json(Room::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Room::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return response()->json($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Room $room)
    {
        $room->update($request->validated());
        return response()->json($room);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json('OK');
    }

    public function guests(Room $room)
    {
        $guests = Guest::with('room')
        ->where('roomId', $room->id)
        ->get();
        return response()->json($guests);
    }
}
