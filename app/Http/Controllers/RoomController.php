<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy('nrRoom')->get();

        return response($rooms, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $countRoom = Room::where('nrRoom', $request->nrRoom)->count();

        if ($countRoom > 0) return response([ "message" => "Room already registered"], 226);

        try {
            $room = Room::create($request->all());
        } catch (\Exception $e) {
            return response([ "message" => "Room Bad Request"], 400);
        }

        return response($room, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::where('id', $id)->delete($id);

        if (!$room) return response([ "message" => "Room Not Found!" ], 404);

        return response('', 204);
    }
}
