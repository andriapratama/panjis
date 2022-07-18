<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengurusModel;

class PengurusController extends Controller
{
	public function __construct()
	{
		$this->PengurusModel = new PengurusModel();
		$this->middleware('auth');
	}


    public function index()
    {
    	$data = [
    		'pengurus' => $this->PengurusModel->allData(),
    	];
    	return view('v_pengurus', $data);
    }

    public function detail($id_pengurus)
    {
    	if (!$this->PengurusModel->detailData($id_pengurus)) {
    		abort(404);
    	}
    	$data = [
    		'pengurus' => $this->PengurusModel->detailData($id_pengurus),
    	];
    	return view('v_detailpengurus', $data);
    }

    public function add()
    {
    	return view('v_addpengurus');
    }

    public function insert()
    {
    	Request()->validate([
        	'nik' => 'required|unique:tbl_pengurus,nik|min:5|max:17',
        	'nama_pengurus' => 'required',
        	'jabatan' => 'required',
       		'foto_pengurus' => 'required|mimes:jpg,jpeg,bmp,png',
    	], [
    		'nik.required' => 'Wajib Diisi',
    		'nik.unique' => 'NIK ini sudah ada',
    		'nik.min' => 'Minimal 5 karakter',
    		'nik.max' => 'Maksimal 17 karakter',
    		'nama_pengurus.required' => 'Wajib Diisi',
    		'jabatan.required' => 'Wajib Diisi',
    		'foto_pengurus.required' => 'Wajib Diisi',
    		'foto_pengurus.mimes' => 'Tipe file harus jpg, jpeg, bmp, atau png',
    	]);

    	//Jika validasi tidak ada maka lakukan simpan data
    	//Upload foto
    	$file = Request()->foto_pengurus;
    	$fileName = Request()->nik . '.' . $file->extension();
    	$file->move(public_path('foto_pengurus'), $fileName);

    	$data =[
    		'nik' => Request()->nik,
    		'nama_pengurus' => Request()->nama_pengurus,
    		'jabatan' => Request()->jabatan,
    		'foto_pengurus' => $fileName,
    	];

    	$this->PengurusModel->addData($data);
    	return redirect()->route('pengurus')->with('pesan', 'Data berhasil ditambahkan');
    }

     public function edit($id_pengurus)
    {
    	if (!$this->PengurusModel->detailData($id_pengurus)) {
    		abort(404);
    	}
    	$data = [
    		'pengurus' => $this->PengurusModel->detailData($id_pengurus),
    	];
    	return view('v_editpengurus', $data);
    }

    public function update($id_pengurus)
    {
    	Request()->validate([
        	'nik' => 'required|min:5|max:17',
        	'nama_pengurus' => 'required',
        	'jabatan' => 'required',
       		'foto_pengurus' => 'mimes:jpg,jpeg,bmp,png',
    	], [
    		'nik.required' => 'Wajib Diisi',
    		'nik.min' => 'Minimal 5 karakter',
    		'nik.max' => 'Maksimal 17 karakter',
    		'nama_pengurus.required' => 'Wajib Diisi',
    		'jabatan.required' => 'Wajib Diisi',
    		'foto_pengurus.mimes' => 'Tipe file harus jpg, jpeg, bmp, atau png',
    	]);

    	//Jika validasi tidak ada maka lakukan simpan data
    	if (Request()->foto_pengurus <> "") {
	    	//Jika ingin ganti foto
	    	//Upload foto
	    	$file = Request()->foto_pengurus;
	    	$fileName = Request()->nik . '.' . $file->extension();
	    	$file->move(public_path('foto_pengurus'), $fileName);

	    	$data =[
	    		'nik' => Request()->nik,
	    		'nama_pengurus' => Request()->nama_pengurus,
	    		'jabatan' => Request()->jabatan,
	    		'foto_pengurus' => $fileName,
	    	];

	    	$this->PengurusModel->editData($id_pengurus, $data);
	    	return redirect()->route('pengurus')->with('pesan', 'Data berhasil di-update');
	    }else {
	    	//Jika tidak ingin ganti foto
	    	$data =[
	    		'nik' => Request()->nik,
	    		'nama_pengurus' => Request()->nama_pengurus,
	    		'jabatan' => Request()->jabatan,
	    	];

	    	$this->PengurusModel->editData($id_pengurus, $data);
	    }
	    	return redirect()->route('pengurus')->with('pesan', 'Data berhasil diperbarui');
    	
    }

    public function delete($id_pengurus)
    {
    	//Hapus Foto
    	$pengurus = $this->PengurusModel->detailData($id_pengurus);
    	if ($pengurus->foto_pengurus <> "") {
    		unlink(public_path('foto_pengurus') . '/' . $pengurus->foto_pengurus);
    	}

    	$this->PengurusModel->deleteData($id_pengurus);
    	return redirect()->route('pengurus')->with('pesan', 'Data berhasil dihapus');
    }


}
