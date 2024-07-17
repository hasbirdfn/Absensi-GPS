{{-- halaman admin izin untuk view user --}}
@extends('layouts.presensi')
@section('header')
<div class="appHeader"  style="background: #0f2e64; color:white">
    <div class="left">
        <a href="/dashboard" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Pengajuan Izin dan Sakit</div>
    <div class="right"></div>
</div>
@endsection
@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        {{-- Alert ketika success dan error --}}
        @php
        $messagesuccess = Session::get('success');
        $messageerror = Session::get('error');
    @endphp

    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ $messagesuccess}}
        </div> 
    @endif
    @if (Session::get('error'))
        <div class="alert alert-danger">
            {{ $messageerror}}
        </div>
       
    @endif
    </div>
</div>
<div class="row">
    <div class="col">
@foreach ($dataizin as $d)
{{-- foreach dataizin untuk melakukan izin dihalaman karyawan --}}
<ul class="listview image-listview">
    <li>
        <div class="item">
            <div class="in">
                <div>
                    {{-- untuk keterangan izin= i, sakit= s, terlambat = t --}}
                   <b>{{date("d-m-Y",strtotime($d->tgl_izin))}}({{$d->status == "s" ? "Sakit" : "Izin"}})</b> <br>
                   <small class="t 0 ext-muted">{{$d->keterangan}}</small>
                </div>
                {{-- status appproved ada 3 
                    1. 0 menunggu
                    2. 1 disetujui
                    3. 2 ditolak
                    --}}
                @if ($d->status_approved == "0")
                    <span class="badge bg-warning">Menunggu</span>
                        @elseif ($d->status_approved == "1")
                        <span class="badge bg-success">Disetujui</span>
                        @elseif ($d->status_approved == "2")
                        <span class="badge bg-danger">Ditolak</span>
                    </span>
                @endif
            </div>  
        </div>
    </li>    
</ul>
@endforeach
    </div>
</div>
<div class="fab-button bottom-right" style="margin-bottom: 70px">
    <a href="/presensi/buatizin" class="fab">
        <ion-icon name="add-outline"></ion-icon>
    </a>
</div>
@endsection
