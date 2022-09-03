<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\NoteDetail;

class NotulenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store', 'update']);
    }

    public function index()
    {
    	return view('v_notulen');
    }

    public function new()
    {
        return view('v_notulenNew');
    }

    public function detail($id)
    {
        return view('v_notulenDetail', ['id' => $id]);
    }

    public function edit($id)
    {
        return view('v_notulenEdit', ['id' => $id]);
    }

    public function store(Request $request)
    {
        $note = Note::create([
            'date'          => $request['date'],
            'title'         => $request['title'],
            'total_member'  => $request['total'],
        ]);

        foreach($request->textList as $key => $value) {
            NoteDetail::create([
                'note_id'   => $note['id'],
                'content'   => $request->textList[$key]['content'],
                'status'    => $request->textList[$key]['status'],
            ]);
        }

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to store note and note detail data',
        ], 201);
    }

    public function getData()
    {
        $data = Note::orderBy('created_at', 'DESC')->paginate(10);

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get notes data',
            'data'      => $data,
        ], 200);
    }

    public function getOneData($id){
        $data = Note::with('note_detail')->where('id', '=', $id)->first();

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to get one note data and note detail by id',
            'data'      => $data,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $data = Note::find($id);
        $data->date = $request['date'];
        $data->title = $request['title'];
        $data->total_member = $request['total'];
        $data->save();

        NoteDetail::where('note_id', '=', $id)->delete();

        foreach($request->textList as $key => $value) {
            NoteDetail::create([
                'note_id'   => $id,
                'content'   => $request->textList[$key]['content'],
                'status'    => $request->textList[$key]['status'],
            ]);
        }

        return response()->json([
            'status'    => 'true',
            'message'   => 'success to update note data'
        ], 200);
    }
}
