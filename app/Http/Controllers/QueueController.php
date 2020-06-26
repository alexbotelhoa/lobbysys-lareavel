<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queue = DB::table('queues')
            ->join('visitors', 'queues.visitor_id', '=', 'visitors.id')
            ->join('rooms', 'queues.room_id', '=', 'rooms.id')
            ->select('queues.*', 'visitors.name', 'visitors.cpf', 'rooms.nrRoom')
            ->orderBy('rooms.nrRoom')
            ->orderBy('visitors.name')
            ->get();

        return response($queue, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $visitorCount = Queue::where('visitor_id', $request->visitor_id)->count();

        if ($visitorCount > 0 ) return response([ "message" => "Visitor is already in the queue"], 203);

        try {
            $queuePosition = Queue::create($request->all());
        } catch (\Exception $e) {
            return response([ "message" => "Queue Position Bad Request"], 400);
        }

        return response($queuePosition, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $queuePosition = Queue::where('id', $id)->delete($id);

        if (!$queuePosition) return response([ "message" => "Queue Position Not Found!" ], 404);

        return response('', 204);
    }
}
