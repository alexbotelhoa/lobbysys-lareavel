<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Visitor[]|\Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = Visitor::all();

        return response($visitors, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response([ "message" => "Route Create Visitor!" ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $visitor = Visitor::create($request->all());

        return response($visitor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visitor = Visitor::find($id);

        if (!$visitor) return response([ "message" => "Visitor Not Found!" ], 404);

        return response($visitor, 302);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visitor = Visitor::find($id);

        if (!$visitor) return response([ "message" => "Visitor Not Found!" ], 404);

        return response([ "message" => "Route Edit Visitor!" ], 200);
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
        $visitor = Visitor::where('id', $id)->update($request->except('_token', '_method'));

        if (!$visitor) return response([ "message" => "Visitor Not Found!" ], 404);

        return response($visitor, 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitor = Visitor::where('id', $id)->delete($id);

        if (!$visitor) return response([ "message" => "Visitor Not Found!" ], 404);

        return response('', 204);
    }
}
