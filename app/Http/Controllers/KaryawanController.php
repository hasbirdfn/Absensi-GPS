<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index(Request $request) 
    {
        $data['title'] = "Data Karyawan";
        $query = Karyawan::query();
        $query->select('karyawan.*', 'nama_dept','nama_status');
        $query->join('departemen','karyawan.kode_dept', '=' , 'departemen.kode_dept');
        $query->join('status','karyawan.kode_status', '=' , 'status.kode_status');
        $query->orderBy('nama_lengkap');
        if (!empty($request->nama_karyawan)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_karyawan . '%');
        }
        if (!empty($request->kode_dept)) {
            $query->where('karyawan.kode_dept', $request->kode_dept);
        }
        if (!empty($request->kode_status)) {
            $query->where('karyawan.kode_status', $request->kode_status);
        }

        $karyawan = $query->paginate(10);
       
        $departemen= DB::table('departemen')->get();
        $status= DB::table('status')->get();
        return view('karyawan.index',$data,compact('karyawan','departemen','status'));
    }

    public function store(Request $request)
     {
        
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $alamat = $request->alamat;
        $kode_status = $request->kode_status;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('12345');
        if ($request->hasFile('foto')){ 
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }
      try {
        $data = [
            'nik' =>$nik,
            'nama_lengkap' => $nama_lengkap,
            'jabatan' => $jabatan,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'kode_status' => $kode_status,
            'kode_dept' => $kode_dept,
            'foto' => $foto,
            'password' => $password
        ];
        $simpan = DB::table('karyawan')->insert($data);
        if ($simpan) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/karyawan/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        }
      } catch (\Exception $e) {
        if ($e->getCode() == 23000) {
            $message = " NIK " . $nik . " Sudah Digunakan!";
        }     
     return Redirect::back()->with(['warning' => 'Data Gagal Disimpan'. $message]);
      }  
     }

     public function edit(Request $request) {
        $nik = $request->nik;
        $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
        $departemen = DB::table('departemen')->get();
        $status = DB::table('status')->get();
        return view('karyawan.edit',compact('departemen','karyawan','status'));
     }

     public function update($nik,Request $request) {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $alamat = $request->alamat;
        $kode_status = $request->kode_status;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('12345');
        $old_foto = $request->old_foto;
        if ($request->hasFile('foto')){ 
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        } 
      try {
        $data = [
            'nama_lengkap' => $nama_lengkap,
            'jabatan' => $jabatan,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'kode_status' => $kode_status,
            'kode_dept' => $kode_dept,
            'foto' => $foto,
            'password' => $password
        ];
        $update = DB::table('karyawan')->where('nik',$nik)->update($data);
        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/karyawan/";
                $folderPathOld = "public/uploads/karyawan/". $old_foto;
                Storage::delete($folderPathOld);
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        }
      } catch (\Exception $e) {
        //  dd($e);
       return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
      }  
     }

     public function delete($nik) {
        $delete = DB::table('karyawan')->where('nik',$nik)->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
     }
}
