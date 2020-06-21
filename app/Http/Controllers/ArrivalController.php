<?php

namespace App\Http\Controllers;

use App\Models\Arrival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArrivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrivals = DB::table('arrivals')
            ->join('visitors', 'arrivals.visitor_id', '=', 'visitors.id')
            ->join('rooms', 'arrivals.room_id', '=', 'rooms.id')
            ->select('arrivals.*', 'visitors.name', 'visitors.cpf', 'rooms.nrRoom')
            ->get();

        return response($arrivals, 200);
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
            $arrival = Arrival::create($request->all());
        } catch (\Exception $e) {
            return response([ "message" => "Arrival Bad Request"], 400);
        }

        return response($arrival, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arrival = Arrival::where('id', $id)->delete($id);

        if (!$arrival) return response([ "message" => "Arrival Not Found!" ], 404);

        return response('', 204);
    }
}
