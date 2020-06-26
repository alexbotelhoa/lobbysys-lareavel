<?php

namespace App\Http\Controllers;

use App\Models\Arrival;
use App\Models\Queue;
use App\Models\Concierge;
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
            ->orderBy('rooms.nrRoom')
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
        $visitorAndRoomExist = Arrival::where([
            ['visitor_id', '=', $request->visitor_id],
            ['room_id', '=', $request->room_id]
        ])->count();

        if ($visitorAndRoomExist > 0) return response([ "message" => "Visitor already registered in the room"], 226);

        $countArrival = Arrival::where('room_id', $request->room_id)->count();

        if ($countArrival > 2) return response([ "message" => "Limit of visitors in the room exceeded"], 203);

        try {
            $arrival = Arrival::create($request->all());
        } catch (\Exception $e) {
            return response([ "message" => "Arrival Bad Request"], 400);
        }

        return response($arrival, 201);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $arrival = Arrival::where('room_id', $id)->count();

    //     if (!$arrival) return response([ "message" => "Arrival Not Found!" ], 404);

    //     return response($arrival, 302);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arrival = Arrival::find($id);

        if (!$arrival) return response([ "message" => "Arrival Not Found!" ], 404);

        $personQueue = DB::table('queues')
            ->join('visitors', 'queues.visitor_id', '=', 'visitors.id')
            ->join('rooms', 'queues.room_id', '=', 'rooms.id')
            ->select('queues.*', 'visitors.name', 'visitors.cpf', 'rooms.nrRoom')
            ->where('room_id', $arrival->room_id)
            ->orderBy('created_at')
            ->limit(1)
            ->get();

        DB::beginTransaction();

        try {
            DB::table('concierges')->insert([
                'visitor_id' => $arrival->visitor_id,
                'room_id' => $arrival->room_id,
                'checkIn' => $arrival->checkIn,
                'checkOut' => now()
            ]);

            DB::table('arrivals')->where('id', $id)->delete($id);

            if (count($personQueue) > 0) {
                DB::table('arrivals')->insert([
                    'visitor_id' => $personQueue[0]->visitor_id,
                    'room_id' => $personQueue[0]->room_id,
                    'checkIn' => now()
                ]);
                
                DB::table('queues')->where('id', $personQueue[0]->id)->delete($personQueue[0]->id);
            }
        
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        };

        if (count($personQueue) > 0) {
            return response($personQueue, 201);
        } else {
            return response('', 204);
        }
    }
}
