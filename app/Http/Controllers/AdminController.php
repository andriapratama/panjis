<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store', 'updateRole']);
    }

    public function index()
    {
    	return view('v_admin');
    }

    public function getData()
    {
        $data = User::get();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get user data',
            'data'      => $data
        ], 200);
    }

    public function updateRole(Request $request)
    {
        $data = User::find($request['id'])->first();
        $data->level = $request['role'];
        $data->save();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to update role admin',
        ], 200);
    }
}
