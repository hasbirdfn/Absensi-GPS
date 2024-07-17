<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KonfigurasiController extends Controller
{
    public function lokasikantor() {
        $data['title'] = "Konfigurasi Lokasi";

        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id',1)->first();
        return view('konfigurasi.lokasikantor',$data,compact('lok_kantor'));
    }

    public function updatelokasikantor(Request $request) {
        $lokasi_kantor = $request->lokasi_kantor;
        $radius = $request->radius;
        $update = DB::table('konfigurasi_lokasi')->where('id',1)->update([
            'lokasi_kantor' => $lokasi_kantor,
            'radius' => $radius
        ]);
        if($update) {
            return Redirect::back()->with(['success'=> 'Data Berhasil Di Update']);
        } else {
            return Redirect::back()->with(['warning'=> 'Data Gagal Di Update']);
        }
    }
}
