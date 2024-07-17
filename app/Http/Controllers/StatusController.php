<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = "Data Status";
       
        $nama_status = $request->nama_status;
        $query = Status::query();
         // ketika sedang mencari nama status 
        $query->select('*');
        if(!empty($nama_status)) {
            $query->where('nama_status', 'like', '%' . $nama_status . '%');
        }
        $status = $query->get();
        return view('status.index', $data,compact('status'));
    }

    public function store(Request $request)
    {
        $kode_status = $request->kode_status;
        $nama_status = $request->nama_status;
        $data = [ 
            'kode_status' => $kode_status,
            'nama_status' => $nama_status
        ];
        $simpan = DB::table('status')->insert($data);
        if ($simpan){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }

    }

    public function edit(Request $request){
        $kode_status = $request->kode_status;
        $status = DB::table('status')->where('kode_status',$kode_status)->first();
        return view('status.edit',compact('status'));
    }

    public function update($kode_status, Request $request)
    {
        $nama_status = $request->nama_status;
        $data = [
            'nama_status' => $nama_status
        ];
        $update = DB::table('status')->where('kode_status',$kode_status)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate!']);
        }
    }
    
    public function delete($kode_status){
        $hapus = DB::table('status')->where('kode_status',$kode_status)->delete(); 
        if ($hapus) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus!']);
        }
    }
}
