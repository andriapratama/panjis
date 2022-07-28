<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryDetail;

class PublikasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store']);
    }

    public function index()
    {
    	return view('v_publikasi');
    }

    public function new()
    {
        return view('v_publikasiNew');
    }

    public function detail($id)
    {
        return view('v_publikasiDetail', ['id' => $id]);
    }

    public function store(Request $request)
    {
        $gallery = Gallery::create([
            'title' => $request['title'],
            'desc'  => $request['desc'],
        ]);

        foreach($request->file('image') as $key => $value) {
            $name = $value['value']->getClientOriginalname();
            $path = $value['value']->store('uploads', 'public');

            GalleryDetail::create([
                'gallery_id'    => $gallery['id'],
                'name'          => $name,
                'path'          => $path
            ]);
        }

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to store gallery data',
        ], 201);
    }

    public function getData()
    {
        $data = Gallery::orderBy("created_at", "DESC")->get();

        return response()->json([
            'status'    => 'true',
            'message'   => "success to get gallery data",
            'data'      => $data,
        ], 200);
    }

    public function getOneData($id)
    {
        $data = Gallery::with('gallery_detail')->where("id", "=", $id)->first();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success get one data by id',
            'data'      => $data
        ], 200);
    }
}
