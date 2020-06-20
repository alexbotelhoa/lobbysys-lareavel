<?php

namespace App\Http\Controllers;

use App\Models\Concierge;
use Illuminate\Http\Request;

class ConciergeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $concierges = Concierge::all();

        return response($concierges, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $concierge = Concierge::create($request->all());
        } catch (\Exception $e) {
            return response([ "message" => "Concierge Bad Request"], 400);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $concierge = Concierge::find($id);

        if (!$concierge) return response([ "message" => "Concierge Not Found!" ], 404);

        try {
            $concierge->update($request->except('_token', '_method'));
        } catch (\Exception $e) {
            return response([ "message" => "Visitor Bad Request"], 400);
        }

        return response($concierge, 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        $concierge = Concierge::where('id', $id)->delete($id);
//
//        if (!$concierge) return response([ "message" => "Concierge Not Found!" ], 404);
//
//        return response('', 204);
    }
}
