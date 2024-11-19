<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRequest;
use App\Http\Requests\Room\PutRequest;
use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::paginate(5);
        return view('dashboard/room/index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::pluck('id', 'name');
        $room = new Room();
        return view('dashboard.room.create', compact('hotels','room'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Room::create($request->validated());
        return to_route('room.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('dashboard/room/show',['room'=>$room]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('dashboard.room.edit', ['room'=>$room]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Room $room)
    {
        $data = $request->validated();
        $room->update($data);
        return to_route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return to_route('room.index');
    }
}
