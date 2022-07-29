<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BarangController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth')->except(['store', 'update']);
	}

    public function index()
    {
    	return view('v_barang');
    }

    public function new()
    {
        return view('v_barangNew');
    }

    public function edit($id)
    {
        return view('v_barangEdit', ['id' => $id]);
    }

    public function store(Request $request)
    {
        Product::create([
            'name'  => $request['name'],
            'quantity'  => $request['quantity'],
            'unit'      => $request['unit'],
        ]);

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to store product data'
        ], 201);
    }

    public function getData()
    {
        $data = Product::get();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get product data',
            'data'      => $data
        ], 200);
    }

    public function getOneData($id)
    {
        $data = Product::find($id);

        return response()->json([
            'status'    => 'true',
            'message'   => 'Success to get one product data',
            'data'      => $data,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $data = Product::find($id);
        $data->name = $request['name'];
        $data->quantity = $request['quantity'];
        $data->unit = $request['unit'];
        $data->save();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to update product data',
        ], 200);
    }
}
