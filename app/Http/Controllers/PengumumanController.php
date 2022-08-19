<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announ;
use Carbon\Carbon;

class PengumumanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store', 'update', 'delete']);
    }

    public function index()
    {
    	return view('v_pengumuman');
    }

    public function new()
    {
    	return view('v_pengumumanNew');
    }

    public function edit($id)
    {
    	return view('v_pengumumanEdit', ['id' => $id]);
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

    public function getDataByDate()
    {
        $today = Carbon::now()->format('Y-m-d');

        $data = Announ::where('date', '>', $today)->orderBy('date', 'ASC')->get();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get data by date',
            'data'      => $data,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $data = Announ::find($id);
        $data->title = $request['title'];
        $data->announ = $request['announ'];
        $data->date = $request['date'];
        $data->save();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to update data'
        ]);
    }

    public function delete($id)
    {
        Announ::where('id', '=', $id)->delete();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to delete announcement data',
        ], 200);
    }
}
