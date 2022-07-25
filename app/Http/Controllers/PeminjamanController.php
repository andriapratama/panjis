<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\Product;
use Dompdf\Dompdf;

class PeminjamanController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth')->except(['store', 'updateStatus']);
	}

    public function index()
    {
    	return view('v_peminjaman');
    }

    public function new()
    {
        return view('v_peminjamanNew');
    }

    public function detail($id)
    {
        return view('v_peminjamanDetail', ['id' => $id]);
    }

    public function print($id)
    {
        return view('v_peminjamanPDF', ['id' => $id]);

        // $dompdf = new Dompdf();
        // $dompdf->loadHtml($html);
        // $dompdf->setPaper('A4', 'potrait');
        // $dompdf->render();
        // $dompdf->stream();
    }

    public function store(Request $request)
    {
        $loan = Loan::create([
            'humas_name'    => $request['humasName'],
            'name'          => $request['name'],
            'address'       => $request['address'],
            'phone'         => $request['phone'],
            'start_date'    => $request['startDate'],
            'end_date'      => $request['endDate'],
            'status'        => 0,
        ]);

        foreach($request->transactionList as $key => $value) {
            LoanDetail::create([
                'loan_id'       => $loan['id'],
                'product_id'    => (int)$request->transactionList[$key]['product'],
                'quantity'      => $request->transactionList[$key]['quantity'],
            ]);
        }

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to store loan and load detail'
        ], 201);
    }

    public function getData()
    {
        $data = Loan::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get loan data',
            'data'      => $data
        ], 200);
    }

    public function getOneData($id)
    {
        $loan = Loan::where('id', '=', $id)->first();

        $detail = DB::table('loan_details')
                    ->join('products', 'products.id', '=', 'loan_details.product_id')
                    ->select('products.name', 'loan_details.quantity')
                    ->where('loan_details.loan_id', '=', $id)
                    ->get();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get loan and load detail by id',
            'loan'      => $loan,
            'detail'    => $detail
        ], 200);
    }

    public function updateStatus($id)
    {
        $data = Loan::find($id);
        $data->status = 1;
        $data->save();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to update status loan'
        ], 200);
    }
}
