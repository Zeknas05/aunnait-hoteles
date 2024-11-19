<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\StoreRequest;
use App\Http\Requests\Guest\PutRequest;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::paginate(5);
        return view('dashboard/guest/index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::pluck('id', 'number');
        $guest = new Guest();
        return view('dashboard.guest.create', compact('rooms','guest'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Guest::create($request->validated());
        return to_route('guest.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return view('dashboard/guest/show',['guest'=>$guest]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        $rooms = Room::pluck('id', 'number');
        return view('dashboard.guest.edit', compact('rooms', 'guest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Guest $guest)
    {
        $data = $request->validated();
        $guest->update($data);
        return to_route('guest.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return to_route('guest.index');
    }
}
