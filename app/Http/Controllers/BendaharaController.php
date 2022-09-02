<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $lastTransaction = Transaction::orderBy("created_at", "DESC")->first();

        $totalCash = 0;

        if (!$lastTransaction) {
            if ($request['status'] === "in") {
                $totalCash = $totalCash + $request['total'];
            } else if ($request['status'] === "out") {
                $totalCash = $totalCash - $request['total'];
            }
        } else {
            if ($request['status'] === "in") {
                $totalCash = $lastTransaction['total_cash'] + $request['total'];
            } else if ($request['status'] === "out") {
                $totalCash = $lastTransaction['total_cash'] - $request['total'];
            }
        }

        $transaction = Transaction::create([
            'user_id'       => $request['userId'],
            'title'         => $request['title'],
            'status'        => $request['status'],
            'total'         => $request['total'],
            'total_cash'    => $totalCash,
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

    public function getTotalMoney()
    {
        $lastTransaction = Transaction::orderBy("created_at", "DESC")->first();

        $totalCash = 0;

        if (!$lastTransaction) {
            $totalCash = 0;
        } else {
            $totalCash = $lastTransaction['total_cash'];
        }

        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');

        $totalIncome = DB::table('transactions')
                        ->where('status', '=', "in")
                        ->whereMonth('created_at', '=', $month)
                        ->whereYear('created_at', '=', $year)
                        ->sum('total');

        $totalSpending = DB::table('transactions')
                        ->where('status', '=', "out")
                        ->whereMonth('created_at', '=', $month)
                        ->whereYear('created_at', '=', $year)
                        ->sum('total');

        return response()->json([
            'status'            => 'true',
            'message'           => 'Success to get total money',
            'totalCash'         => $totalCash,
            'totalIncome'       => (int)$totalIncome,
            'totalSpending'     => (int)$totalSpending,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $findTransaction = Transaction::find($id);

        $findLastTransaction = Transaction::orderBy('created_at', 'DESC')->first();

        $totalCash = 0;

        if ($findTransaction['status'] === "in") {
            $totalCash = $findLastTransaction['total_cash'] - $findTransaction['total'];
        } else if ($findTransaction['status'] === "out") {
            $totalCash = $findLastTransaction['total_cash'] + $findTransaction['total'];
        }

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

        if ($request['status'] === "in") {
            $totalCash = $totalCash + $request['total'];
        } else if ($request['status'] === 'out') {
            $totalCash = $totalCash - $request['total'];
        }

        $findLastTransaction->total_cash = $totalCash;
        $findLastTransaction->save();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to update data transaction',
        ], 200);
    }

    public function delete($id)
    {
        $findTransaction = Transaction::find($id);

        $findLastTransaction = Transaction::orderBy('created_at', 'DESC')->first();

        $totalCash = 0;

        if ($findTransaction['status'] === "in") {
            $totalCash = $findLastTransaction['total_cash'] - $findTransaction['total'];
        } else if ($findTransaction['status'] === "out") {
            $totalCash = $findLastTransaction['total_cash'] + $findTransaction['total'];
        }

        TransactionDetail::where('transaction_id', '=', $id)->delete();

        Transaction::where('id', '=', $id)->delete();

        if ($findTransaction['id'] === $findLastTransaction['id']) {
            $lastTransaction = Transaction::orderBy('created_at', 'DESC')->first();

            if (!$lastTransaction) {
                return response()->json([
                    'status'    => 'true',
                    'message'   => 'succes to delete transaction data',
                ], 200);
            } else {
                $lastTransaction->total_cash = $totalCash;
                $lastTransaction->save();
    
                return response()->json([
                    'status'    => 'true',
                    'message'   => 'succes to delete transaction data',
                ], 200);
            }
        } else {
            $findLastTransaction->total_cash = $totalCash;
            $findLastTransaction->save();

            return response()->json([
                'status'    => 'false',
                'message'   => 'succes to delete transaction data',
            ], 200);
        }
    }
}
