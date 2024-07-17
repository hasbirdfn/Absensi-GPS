@extends('layouts.presensi')
@section('content')
<style>
    .logout {
        position: absolute;
        color: white;
        font-size: 30px;
        text-decoration: none;
        right: 8px;
    }
    .logout:hover{
        color:white;
    }
</style>
<div class="section" id="user-section">
    <a href="/proseslogout" class="logout"><ion-icon name="exit-outline"></ion-icon></a>
    <div id="user-detail">
        <div class="avatar">
            @if (!empty(Auth::guard('karyawan')->user()->foto))
            @php
                $path = Storage::url('uploads/karyawan/'. Auth::guard('karyawan')->user()->foto);
            @endphp
            <img src="{{url($path)}}" alt="avatar" class="imaged w64" style="height:70px; width: 30px" >
            @else
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64">
            @endif
        </div>
        <div id="user-info">
            <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap}}</h2>
            <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan}}</span>
        </div>
    </div> 
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/editprofile" class="green" style="font-size: 40px;">
                            <ion-icon name="person-sharp"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Profil</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/histori" class="danger" style="font-size: 40px;">
                            <ion-icon name="calendar-number"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/izin" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Izin</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/create" class="orange" style="font-size: 40px;">
                            <ion-icon name="camera"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        Absen
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($presensihariini != null)
                                @php
                                    $path = Storage::url('uploads/absensi/'. $presensihariini->foto_in)
                                @endphp
                                <img src="{{url($path)}}" alt="Absen Masuk" class="imaged w48">
                                @else
                                <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Masuk</h4>
                                <span>{{$presensihariini != null ? $presensihariini->jam_in : 'Belum Absen'}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($presensihariini != null && $presensihariini->jam_out != null)
                                @php
                                    $path = Storage::url('uploads/absensi/'.$presensihariini->foto_out)
                                @endphp
                                <img src="{{url($path)}}" alt="" class="imaged w48">
                                @else
                                <ion-icon name="camera"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Pulang</h4>
                                <span>{{$presensihariini != null && $presensihariini->jam_out != null  ? $presensihariini->jam_out : 'Belum Absen'}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="rekappresensi">
        <h3>Rekap Presensi Bulan {{$namabulan[$bulanini]}} Tahun {{$tahunini}}</h3>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                        <span class="badge bg-danger" style="position: absolute; top:3px; right: 10px; font-size:0.6rem; z-index:999">{{$rekappresensi->jmlhadir}}</span>
                        <ion-icon name="accessibility-outline" style="font-size: 1.6rem;" class="text-primary mb-1"></ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                        <span class="badge bg-danger" style="position: absolute; top:3px; right: 10px; font-size:0.6rem; z-index:999">{{$rekapizin->jmlizin}}</span>
                        <ion-icon name="newspaper-outline" style="font-size: 1.6rem;" class="text-success mb-1">Izin</ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                        <span class="badge bg-danger" style="position: absolute; top:3px; right: 10px; font-size:0.6rem; z-index:999">{{$rekapizin->jmlsakit}}</span>
                        <ion-icon name="medkit-outline" style="font-size: 1.6rem;" class="text-danger mb-1">Sakit</ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important; line-height: 0.8rem">
                        <span class="badge bg-danger" style="position: absolute; top:3px; right: 10px; font-size:0.6rem; z-index:999">{{$rekappresensi->jmlterlambat}}</span>
                        <ion-icon name="alarm-outline" style="font-size: 1.6rem;" class="text-warning mb-1">Telat</ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Telat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="presencetab mt-2">
        <div class="tab-pane fade show active" id="pilled" role="tabpanel">
            <ul class="nav nav-tabs style1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        Bulan Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                       Leaderboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-2" style="margin-bottom:100px;">
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($historibulanini as $d )
                    @php
                        $path = Storage::url('uploads/absensi/' . $d->foto_in);
                    @endphp
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="finger-print-outline"></ion-icon> 
                            </div>
                            <div class="in">
                                <div>{{date("d-m-Y",strtotime($d->tgl_presensi))}}</div>
                                <span class="badge badge-success">{{$d->jam_in}}</span>
                                <span class="badge badge-danger">{{$historibulanini != null && $d->jam_out != null ? $d->jam_out : 'Belum Absen'}}</span>
                            </div>
                        </div>
                    </li>    
                    @endforeach
                </ul>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($leaderboard as $d)
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>
                                    <b>{{$d->nama_lengkap}}</b><br>
                                    <small class="text-muted">{{$d->jabatan}}</small>
                                </div>
                                <span class="badge {{$d->jam_in < "08:30" ? "bg-success" : "bg-danger"}}">
                                    {{$d->jam_in}}
                                </span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection