{{-- halaman view izinsakit pada karyawan --}}
@extends('layouts.presensi')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
{{-- link css untuk merubah warna datepicker / tanggal --}}
<style>
    .datepicker-modal{
        max-height: 430px;
    }  

    .datepicker-date-display{
        background-color: #0f2e64 !important;
    }

    .datepicker-done {
        color: #0f2e64;
    }
    .datepicker-cancel {
        color: #0f2e64;
    }
</style>

{{-- header bagian atas --}}
<div class="appHeader"  style="background: #0f2e64; color:white">
    <div class="left">
        <a href="/dashboard" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Pilih Izin dan Sakit</div>
    <div class="right"></div>
</div>
@endsection
@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        {{-- form action untuk mengirim data izin dan sakit --}}
           <form method="POST" action="/presensi/storeizin" id="frmIzin">
            @csrf
            <div class="form-group">
                <input type="text" id="tgl_izin" name="tgl_izin" class="form-control datepicker" placeholder="Tanggal">
            </div>
            <div class="form-group">
                <select name="status" id="status" class="form-control">
                    <option value="">Izin / Sakit</option>
                    <option value="i">Izin</option>
                    <option value="s">Sakit</option>
                </select>
            </div>
            <div class="form-group">
                <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"></textarea>
            </div>
             <div class="form-group">
            <button class="btn w-100" style="background: #0f2e64; color:white">Kirim</button>
            </div>   
        </form>
    </div>
</div> 
@endsection

@push('myscript')
    <script>
        //konfigurasi untuk jquery  
        var currYear = (new Date()).getFullYear();
 
        $(document).ready(function() {
            $(".datepicker").datepicker({
            format: "yyyy-mm-dd"    
        });
        
        // menggunakan .change untuk merespon pada izin
        $("#tgl_izin").change(function(e) {
            var tgl_izin = $(this).val();
           $.ajax({
            type: 'POST',
            url: '/presensi/cekpengajuanizin',
            data: {
                _token: "{{csrf_token()}}",
                tgl_izin: tgl_izin
            },
            cache:false,
            // alert ketika data izin dilakukan dihari yang sama
            success:function(respond){
                if(respond == 1){
                    Swal.fire({
                        title: 'Hay Kak!',
                        text: 'Tidak Bisa Menginput Dengan Tanggal Yang Sama!',
                        icon: 'warning'
                    }).then((result)=>{
                        $("#tgl_izin").val("");
                    });
                }
            }
           });
        });
        // function ketika diklik 
        // mengambil value tgl_izin,status,keterangan
        $("#frmIzin").submit(function() {
            var tgl_izin = $("#tgl_izin").val();
            var status = $("#status").val();
            var keterangan = $("#keterangan").val();
            if(respond == "") {
                Swal.fire({
                        title: 'Hay Kak!',
                        text: 'Tanggal Harus Diisi Yah!',
                        icon: 'warning'
                });
                return false;
            } else if (status == "") {
                Swal.fire({
                        title: 'Hay Kak!',
                        text: 'Status Harus Diisi Yah!',
                        icon: 'warning'
                });
                return false;
            } else if (keterangan == "") {
                Swal.fire({
                        title: 'Hay Kak!',
                        text: 'Keterangan Harus Diisi Yah!',
                        icon: 'warning'
                });
                return false;
            }
        });
    });
    </script>
@endpush