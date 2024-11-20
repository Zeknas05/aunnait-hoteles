<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreRequest;
use App\Http\Requests\Hotel\PutRequest;
use App\Models\Hotel;
use App\Models\Service;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::paginate(5);
        return view('dashboard/hotel/index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::pluck('id', 'name');
        $hotel = new Hotel();
        return view('dashboard.hotel.create', compact('services','hotel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Hotel::create($request->validated());
        return to_route('hotel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        $hotel = $hotel->load('services');
        return view('dashboard/hotel/show',['hotel'=>$hotel]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        $services = Service::pluck('id', 'name');
        return view('dashboard.hotel.edit', compact('services', 'hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Hotel $hotel)
    {
        $hotel->update($request->validated());
        return to_route('hotel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return to_route('hotel.index');
    }
}
