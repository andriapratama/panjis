<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store']);
    }

    public function index()
    {
    	return view('v_bendahara');
    }

    public function new($status)
    {
        return view('v_bendaharaTransaksi', ['status' => $status]);
    }

    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'user_id'   => $request['userId'],
            'status'    => $request['status'],
            'total'     => $request['total'],
        ]);

        foreach($request->transactionList as $key => $value) {
            TransactionDetail::create([
                'transaction_id'    => $transaction['id'],
                'name'              => $request->transactionList[$key]['name'],
                'sub_total'         => $request->transactionList[$key]['subTotal'],
            ]);
        }

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to store transaction and transaction detail',
        ], 201);
    }

    public function getData()
    {
        $transaction = Transaction::orderBy("created_at", "DESC")->get();

        return response()->json([
            'status'    => 'true',
            'message'   => 'Success to get data transaction',
            'data'      => $transaction
        ], 200);
    }
}
