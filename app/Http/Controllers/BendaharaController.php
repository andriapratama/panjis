<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store', 'update', 'delete']);
    }

    public function index()
    {
    	return view('v_bendahara');
    }

    public function new($status)
    {
        return view('v_bendaharaTransaksi', ['status' => $status]);
    }

    public function detail($id)
    {
        return view('v_bendaharaDetail', ['id' => $id]);
    }

    public function edit($id)
    {
        return view('v_bendaharaEdit', ['id' => $id]);
    }

    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'user_id'   => $request['userId'],
            'title'     => $request['title'],
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

    public function getOneData($id)
    {
        $data = Transaction::with('transaction_detail')->where("id", '=', $id)->first();

        return response()->json([
            'status'    => 'true',
            'message'   => 'Success to get one data transaction with transaction detail',
            'data'      => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $data = Transaction::find($id);
        $data->user_id = $request['userId'];
        $data->title = $request['title'];
        $data->status = $request['status'];
        $data->total = $request['total'];
        $data->save();

        TransactionDetail::where('transaction_id', '=', $id)->delete();

        foreach($request->transactionList as $key => $value) {
            TransactionDetail::create([
                'transaction_id'    => $id,
                'name'              => $request->transactionList[$key]['name'],
                'sub_total'         => $request->transactionList[$key]['subTotal'],
            ]);
        }

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to update data transaction',
        ], 200);
    }

    public function delete($id)
    {
        TransactionDetail::where('transaction_id', '=', $id)->delete();

        Transaction::where('id', '=', $id)->delete();

        return response()->json([
            'status'    => 'true',
            'message'   => 'succes to delete transaction data',
        ], 200);
    }
}
