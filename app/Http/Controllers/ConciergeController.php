<?php

namespace App\Http\Controllers;

use App\Models\Concierge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConciergeController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        try {
            $concierge = DB::table('concierges')
                ->join('visitors', 'concierges.visitor_id', '=', 'visitors.id')
                ->join('rooms', 'concierges.room_id', '=', 'rooms.id')
                ->where('concierges.visitor_id', 'LIKE', '%' . $request->visitor . '%')
                ->where('concierges.room_id', 'LIKE', '%' . $request->room . '%')
                ->where('concierges.checkIn', 'LIKE', '%' . $request->date . '%')
                ->select('concierges.*', 'visitors.name', 'visitors.cpf', 'rooms.nrRoom')
                ->get();
        } catch (\Exception $e) {
            return response(["message" => "Concierge Bad Request"], 400);
        }

        if (!$concierge) return response([ "message" => "Concierge Not Found!" ], 404);

        return response($concierge, 200);        
    }
}
