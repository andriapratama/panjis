<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;

class LpjController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store']);
    }

    public function index()
    {
    	return view('v_lpj');
    }

    public function new()
    {
        return view('v_lpjNew');
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
}
