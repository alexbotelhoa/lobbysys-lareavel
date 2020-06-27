<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = Visitor::orderBy('name')->get();

        return response($visitors, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $countVisitor = Visitor::where('cpf', $request->cpf)->count();

        if ($countVisitor > 0) return response([ "message" => "Visitor already registered"], 226);

        try {
            $visitor = Visitor::create($request->all());
        } catch (\Exception $e) {
            return response([ "message" => "Visitor Bad Request"], 400);
        }

        return response($visitor, 201);
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
