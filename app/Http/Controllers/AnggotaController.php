<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class AnggotaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except(['store']);
	}

    public function index()
    {
    	return view('v_anggota');
    }

	public function new()
	{
		return view('v_anggotaNew');
	}

	public function detail($id)
	{
		return view('v_anggotaDetail', ['id' => $id]);
	}

	public function store(Request $request)
	{
		Member::create([
			'nik'			=> (int)$request['nik'],
			'full_name'		=> $request['name'],
			'address'		=> $request['address'],
			'phone_number'	=> $request['phone'],
			'gender'		=> $request['gender']
		]);

		return response()->json([
			'status'	=> 'true',
			'message'	=> 'Success to store member data',
		], 201);
	}

	public function getData()
	{
		$data = Member::orderBy('created_at', 'DESC')->get();

		return response()->json([
			'status'	=> 'true',
			'message'	=> 'Success to get member data',
			'data'		=> $data
		], 200);
	}

	public function getOneData($id)
	{
		$data = Member::where('id', '=', $id)->first();

		return response()->json([
			'status'	=> 'true',
			'message'	=> 'success get one member data by id',
			'data'		=> $data
		], 200);
	}
}
