<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;

class LpjController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store', 'updateTitle', 'updateFile']);
    }

    public function index()
    {
    	return view('v_lpj');
    }

    public function new()
    {
        return view('v_lpjNew');
    }

    public function edit($id)
    {
        return view('v_lpjEdit', ['id' => $id]);
    }

    public function store(Request $request)
    {
        $path = $request->file('file')->store('files', 'public');

        Report::create([
            'title' => $request['title'],
            'file'  => $path
        ]);

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to store report data',
        ], 201);
    }

    public function getData()
    {
        $data = Report::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'status'    => 'true',
            'message'   => 'Success to get report data',
            'data'      => $data,
        ], 200);
    }

    public function getOneData($id)
    {
        $data = Report::find($id);

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get one report data',
            'data'      => $data,
        ], 200);
    }

    public function updateTitle(Request $request, $id)
    {
        $data = Report::find($id);
        $data->title = $request['title'];
        $data->save();
    
        return response()->json([
            'status'    => 'true',
            'message'   => 'success to update data title',
        ], 200);
    }

    public function updateFile(Request $request, $id)
    {
        $path = $request->file('file')->store('files', 'public');

        $data = Report::find($id);
        $data->file = $path;
        $data->save();
    
        return response()->json([
            'status'    => 'true',
            'message'   => 'success to update data file',
        ], 200);
    }
}
