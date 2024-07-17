{{-- halaman histori ada di view karyawan
    1. halaman ini mengatur segala kebutuhan untuk histori absensi
    2. berdasarkan bulan dan tahun
    --}}
@extends('layouts.presensi')
@section('header')
<div class="appHeader"  style="background: #0f2e64; color:white">
    <div class="left">
        <a href="/dashboard" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Histori Absensi</div>
    <div class="right"></div>
</div>
@endsection
@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    {{-- menampilkan data bulan sebanyak 12 bulan --}}
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="">Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                        <option value="{{$i}}" {{date("m") == $i ? 'selected' : '' }}>{{$namabulan[$i]}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    {{-- menampilkan tahun berdasarkan data --}}
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">Tahun</option>
                        @php
                            $tahunmulai = 2022;
                            $tahunberjalan = date("Y");
                        @endphp
                        @for ($tahun = $tahunmulai; $tahun <= $tahunberjalan; $tahun++)
                        <option value="{{$tahun}}" {{date("Y") == $tahun ? 'selected' : '' }}>{{$tahun}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                       <button class="btn btn-block" id="getdata" style="background:#0f2e64; color: white"><ion-icon name="search-outline"></ion-icon>Cari Data</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col" id="showhistori"></div>
</div>
@endsection

@push('myscript')
<script>
    // function untuk mengambil data bulan dan tahun
    $(function() {
        $("#getdata").click(function(e) {
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();

            $.ajax({
                type: 'POST',
                url: '/gethistori',
                data: {
                    _token: "{{csrf_token()}}",
                    bulan: bulan,
                    tahun: tahun
                },
                cache: false,
                success: function(respond) {
                     $("#showhistori").html(respond);
                }
            });
        });
    });
</script>    
@endpush