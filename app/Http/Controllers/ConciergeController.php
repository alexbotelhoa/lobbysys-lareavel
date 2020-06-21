<?php

namespace App\Http\Controllers;

use App\Models\Concierge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConciergeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $concierges = DB::table('concierges')
            ->join('visitors', 'concierges.visitor_id', '=', 'visitors.id')
            ->join('rooms', 'concierges.room_id', '=', 'rooms.id')
            ->select('concierges.*', 'visitors.name', 'visitors.cpf', 'rooms.nrRoom')
            ->get();

        return response($concierges, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $concierge = Concierge::create($request->all());
        } catch (\Exception $e) {
            return response(["message" => "Concierge Bad Request"], 400);
        }

        return response($concierge, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $concierge = Concierge::find($id);

        $concierge = DB::table('concierges')
            ->join('visitors', 'concierges.visitor_id', '=', 'visitors.id')
            ->join('rooms', 'concierges.room_id', '=', 'rooms.id')
            ->where('concierges.id', '=', $id)
            ->select('concierges.*', 'visitors.name', 'visitors.cpf', 'rooms.nrRoom')
            ->get();


        if (!$concierge) return response([ "message" => "Concierge Not Found!" ], 404);

        return response($concierge, 302);
    }
}
