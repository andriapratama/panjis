<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            'user_id'   => 1,
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
}
