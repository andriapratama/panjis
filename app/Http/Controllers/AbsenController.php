<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Absent;
use App\Models\AbsentDetail;

class AbsenController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth')->except(['store', 'updateAbsentDetail', 'updateDataTitle']);
	}

    public function index()
    {
    	return view('v_absen');
    }

    public function new()
    {
        return view('v_absenNew');
    }

    public function detail($id)
    {
        return view('v_absenDetail', ['id' => $id]);
    }

    public function store(Request $request)
    {
        $absent = Absent::create([
            'title'         => $request['title'],
            'total'         => 0,
            'created_at'    => Carbon::now()->format('Y-m-d'),
            'updated_at'    => Carbon::now()->format('Y-m-d'),
        ]);

        $member = Member::get();

        foreach($member as $key => $value) {
            AbsentDetail::create([
                'absent_id' => $absent['id'],
                'member_id' => $member[$key]['id'],
                'status'    => 0
            ]);
        }

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to create new absent and absent detail'
        ], 201);
    }

    public function getFirstData()
    {
        $absent = Absent::orderBy('id', 'DESC')->first();

        $data = DB::table('absents')
                ->join('absent_details', 'absents.id', '=', 'absent_details.absent_id')
                ->join('members', 'members.id', '=', 'absent_details.member_id')
                ->select('absents.created_at', 'members.full_name', 'absent_details.id', 'absent_details.status')
                ->where('absents.id', '=', $absent['id'])
                ->get();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to create new absent and absent detail and get it',
            'absent'    => $absent,
            'data'      => $data
        ], 200);
    }

    public function UpdateAbsentDetail(Request $request)
    {
        $data = AbsentDetail::find($request['absentDetailId']);
        $data->status = (int)$request['status'];
        $data->save();

        $absent = Absent::find($data['absent_id']);
        if ($request['status'] === '1') {
            $absent->total = $absent->total + 1;
            $absent->save();
        } else if ($request['status'] === '0') {
            $absent->total = $absent->total - 1;
            $absent->save();
        }

        return response()->json([
            'status'    => 'true',
            'message'   => 'Success to update status absent detail',
            'data'      => $data,
            'absent'    => $absent
        ], 200);
    }

    public function getData()
    {
        $data = Absent::orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get absent data',
            'data'      => $data
        ], 200);
    }

    public function getOneData($id)
    {
        $absent = Absent::where('id', '=', $id)->first();
        
        $data = DB::table('absents')
                ->join('absent_details', 'absents.id', '=', 'absent_details.absent_id')
                ->join('members', 'members.id', '=', 'absent_details.member_id')
                ->select('absents.created_at', 'members.full_name', 'absent_details.id', 'absent_details.status')
                ->where('absents.id', '=', $id)
                ->get();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to open one absent data with id',
            'absent'    => $absent,
            'data'      => $data
        ], 200);
    }

    public function getTitleData($id)
    {
        $data = Absent::find($id);

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to find title',
            'data'      => $data,
        ], 200);
    }

    public function updateDataTitle(Request $request, $id)
    {
        $data = Absent::find($id);
        $data->title = $request['title'];
        $data->save();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to update title absent',
        ], 200);
    }
}
