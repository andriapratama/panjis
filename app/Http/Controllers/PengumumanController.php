<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announ;

class PengumumanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store']);
    }

    public function index()
    {
    	return view('v_pengumuman');
    }

    public function new()
    {
    	return view('v_pengumumanNew');
    }

    public function store(Request $request)
    {
        Announ::create([
            'title'     => $request['title'],
            'announ'    => $request['announ'],
            'date'      => $request['date'],
        ]);

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to store announcements data',
        ], 201);
    }

    public function getData()
    {
        $data = Announ::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get announcements data',
            'data'      => $data,
        ], 200);
    }

    public function getOneData($id)
    {
        $data = Announ::where('id', '=', $id)->first();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success get one announcement data by id',
            'data'      => $data,
        ], 200);
    }
}
