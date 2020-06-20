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
        $rooms = Room::all();

        return response($rooms, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response([ "message" => "Route Create Room!" ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $room = Room::create($request->all());
        } catch (\Exception $e) {
            return response([ "message" => "Room Bad Request"], 400);
        }

        return response($room, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);

        if (!$room) return response([ "message" => "Room Not Found!" ], 404);

        return response($room, 302);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);

        if (!$room) return response([ "message" => "Room Not Found!" ], 404);

        return response([ "message" => "Route Edit Room!" ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room = Room::find($id);

        if (!$room) return response([ "message" => "Room Not Found!" ], 404);

        try {
            $room->update($request->except('_token', '_method'));
        } catch (\Exception $e) {
            return response([ "message" => "Room Bad Request"], 400);
        }

        return response($room, 202);
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
