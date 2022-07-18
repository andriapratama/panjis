<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaModel;

class AnggotaController extends Controller
{
	public function __construct()
	{
		$this->AnggotaModel = new AnggotaModel();
		$this->middleware('auth');
	}


    public function index()
    {
    	$data = [
    		'anggota' => $this->AnggotaModel->allData(),
    	];
    	return view('v_anggota', $data);
    }

    public function detail($id_anggota)
    {
    	if (!$this->AnggotaModel->detailData($id_anggota)) {
    		abort(404);
    	}
    	$data = [
    		'anggota' => $this->AnggotaModel->detailData($id_anggota),
    	];
    	return view('v_detailanggota', $data);
    }

    public function add()
    {
    	return view('v_addanggota');
    }

    public function insert()
    {
    	Request()->validate([
        	'nik' => 'required|unique:tbl_anggota,nik|min:5|max:17',
        	'nama_anggota' => 'required',
        	'alamat' => 'required',
       		'no_hp' => 'required',
    	], [
    		'nik.required' => 'Wajib Diisi',
    		'nik.unique' => 'NIK ini sudah ada',
    		'nik.min' => 'Minimal 5 karakter',
    		'nik.max' => 'Maksimal 17 karakter',
    		'nama_anggota.required' => 'Wajib Diisi',
    		'alamat.required' => 'Wajib Diisi',
    		'no_hp.required' => 'Wajib Diisi',
    	]);

    	$data =[
    		'nik' => Request()->nik,
    		'nama_anggota' => Request()->nama_anggota,
    		'alamat' => Request()->alamat,
    		'no_hp' => Request()->no_hp,
    	];

    	$this->AnggotaModel->addData($data);
    	return redirect()->route('anggota')->with('pesan', 'Data berhasil ditambahkan');
    }

     public function edit($id_anggota)
    {
    	if (!$this->AnggotaModel->detailData($id_anggota)) {
    		abort(404);
    	}
    	$data = [
    		'anggota' => $this->AnggotaModel->detailData($id_anggota),
    	];
    	return view('v_editanggota', $data);
    }

    public function update($id_anggota)
    {
    	Request()->validate([
        	'nik' => 'required|unique:tbl_anggota,nik|min:5|max:17',
        	'nama_anggota' => 'required',
        	'alamat' => 'required',
       		'no_hp' => 'required',
    	], [
    		'nik.required' => 'Wajib Diisi',
    		'nik.min' => 'Minimal 5 karakter',
    		'nik.max' => 'Maksimal 17 karakter',
    		'nama_anggota.required' => 'Wajib Diisi',
    		'alamat.required' => 'Wajib Diisi',
    		'no_hp.required' => 'Wajib Diisi',
    	]);
	    	return redirect()->route('anggota')->with('pesan', 'Data berhasil diperbarui');
    	
    }

    public function delete($id_anggota)
    {
    	//Hapus Foto
    	$anggota = $this->AnggotaModel->detailData($id_anggota);
    	if ($anggota->foto_anggota <> "") {
    		unlink(public_path('foto_anggota') . '/' . $anggota->foto_anggota);
    	}

    	$this->AnggotaModel->deleteData($id_anggota);
    	return redirect()->route('anggota')->with('pesan', 'Data berhasil dihapus');
    }


}
