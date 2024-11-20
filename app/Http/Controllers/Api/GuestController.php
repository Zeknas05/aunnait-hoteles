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
    public function index(Request $request)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $passportID = $request->input('passportID');
        $checkinDate = $request->input('checkinDate');
        $checkoutDate = $request->input('checkoutDate');
        $roomId = $request->input('roomId');

        $perPage = $request->input('per_page', 5);
        $page = $request->input('page', 1);

        $query = Guest::query();

        if($name){
            $query->where('name', 'LIKE', "%{$name}%");
        }
        if($surname){
            $query->where('surname', 'LIKE', "%{$surname}%");
        }
        if($passportID){
            $query->where('passportID', 'LIKE', "%{$passportID}%");
        }
        if($checkinDate){
            $query->where('checkinDate', 'LIKE', "%{$checkinDate}%");
        }
        if($checkoutDate){
            $query->where('checkoutDate', 'LIKE', "%{$checkoutDate}%");
        }
        if($roomId){
            $query->where('roomId', 'LIKE', "%{$roomId}%");
        }

        return response()->json($query->paginate($perPage, ['*'], 'page', $page));
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
