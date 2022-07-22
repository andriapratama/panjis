<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth')->except(['store']);
	}

    public function index()
    {
    	return view('v_peminjaman');
    }

    public function new()
    {
        return view('v_peminjamanNew');
    }
}
