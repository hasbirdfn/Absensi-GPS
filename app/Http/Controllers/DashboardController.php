<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index() 
    {   
        $hariini = date("Y-m-d");
        $bulanini = date("m") * 1; //satu atau Januari
        $tahunini = date("Y"); //2023
        $nik = Auth::guard('karyawan')->user()->nik;
        $presensihariini = DB::table('presensi')->where('nik',$nik)->where('tgl_presensi', $hariini)->first();
        $historibulanini = DB::table('presensi')
        ->where('nik',$nik)
        ->whereRaw('MONTH(tgl_presensi)="'. $bulanini . '"')
        ->whereRaw('YEAR(tgl_presensi)="'. $tahunini . '"')
        ->orderBy('tgl_presensi')
        ->get();

        $rekappresensi = DB::table('presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "08:30",1,0)) as jmlterlambat')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'. $bulanini . '"')
        ->whereRaw('YEAR(tgl_presensi)="'. $tahunini . '"')
        ->first();
        
        $leaderboard = DB::table('presensi')
        ->join('karyawan', 'presensi.nik', '=' , 'karyawan.nik')
        ->where('tgl_presensi', $hariini)
        ->orderBy('jam_in')
        ->get();    
        
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        
        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin,SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_izin)="'. $bulanini . '"')
        ->whereRaw('YEAR(tgl_izin)="'. $tahunini . '"')
        ->where('status_approved', 1)
        ->first();
        return view('dashboard.dashboard',compact('presensihariini','historibulanini','namabulan','bulanini','tahunini','rekappresensi','leaderboard','rekapizin'));
    }

    public function abcd() {
        return view('presensi.abcd');
    }
    public function dashboardadmin() {
        return view ('dashboard.dashboardadmin');
    }
}
