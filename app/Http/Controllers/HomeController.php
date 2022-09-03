<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Report;
use App\Models\Note;
use App\Models\Member;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('v_home');
    }

    public function getData()
    {
        $transaction = Transaction::count();

        $user = User::count();

        $gallery = Gallery::count();

        $note = Note::count();

        $report = Report::count();

        $member = Member::count();

        return response()->json([
            'status'        => 'true',
            'message'       => 'Success to get data',
            'transaction'   => $transaction,
            'user'          => $user,
            'gallery'       => $gallery,
            'note'          => $note,
            'report'        => $report,
            'member'        => $member,
        ]);
    }
}
