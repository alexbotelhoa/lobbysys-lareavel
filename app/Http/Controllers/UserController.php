<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        return response($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $countUser = User::where('email', $request->email)->count();

        if ($countUser > 0) return response([ "message" => "User already registered"], 226);

        try {
            $user = User::create($request->all());
        } catch (\Exception $e) {
            return response([ "message" => "User Bad Request"], 400);
        }

        return response($user, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->delete($id);

        if (!$user) {
            return response(["message" => "User Not Found!"], 404);
        }

        return response('', 204);
    }
}
