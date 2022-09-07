<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gallery;
use App\Models\GalleryDetail;

class IndexController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('clients/v_home');
    }

    public function gallery()
    {
        return view('clients/v_gallery');
    }

    public function galleryDetail($id)
    {
        return view('clients/v_galleryDetail', ['id' => $id]);
    }

    public function getGallery()
    {
        $data = Gallery::with('gallery_detail')->get();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get all data gallery and detail',
            'data'      => $data
        ]);
    }

    public function getOneGallery($id)
    {
        $data = Gallery::with('gallery_detail')->find($id);

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get one data gallery',
            'data'      => $data
        ]);
    }
}

