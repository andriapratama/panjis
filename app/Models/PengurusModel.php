<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PengurusModel extends Model
{
	public function allData()
    {
    	return DB::table('tbl_pengurus')->get();
    }

    public function detailData($id_pengurus)
    {
    	return DB::table('tbl_pengurus')->where('id_pengurus', $id_pengurus)->first();
    }

    public function addData($data)
    {
    	DB::table('tbl_pengurus')->insert($data);
    }

    public function editData($id_pengurus, $data)
    {
    	DB::table('tbl_pengurus')
    		->where('id_pengurus', $id_pengurus)
    		->update($data);
    }

    public function deleteData($id_pengurus)
    {
    	DB::table('tbl_pengurus')
    		->where('id_pengurus', $id_pengurus)
    		->delete();
    }
}
