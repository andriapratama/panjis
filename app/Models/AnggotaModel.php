<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AnggotaModel extends Model
{
	public function allData()
    {
    	return DB::table('users')->get();
    }

    public function detailData($id_anggota)
    {
    	return DB::table('tbl_anggota')->where('id_anggota', $id_anggota)->first();
    }

    public function addData($data)
    {
    	DB::table('tbl_anggota')->insert($data);
    }

    public function editData($id_anggota, $data)
    {
    	DB::table('tbl_anggota')
    		->where('id_anggota', $id_anggota)
    		->update($data);
    }

    public function deleteData($id_anggota)
    {
    	DB::table('tbl_anggota')
    		->where('id_anggota', $id_anggota)
    		->delete();
    }
}
