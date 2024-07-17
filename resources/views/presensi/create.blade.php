{{-- Halaman presensi/create ini adalah untuk melakukan absen masuk dan pulang
    konfigurasi gambar,notifikasi,lokasi  dll diatur disini
    --}}

@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader" style="background: #0f2e64;  color: white;">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">SIlahkan Melakukan Absensi</div>
    <div class="right"></div>
</div>

<style>
   /* ini adalah untuk mengatur camera, dari ukuran, lebar,tinggi dll */
    .webcam-capture,
    .webcam-capture video {
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 15px;
    }
    /* ini css untuk mengatur jarak dari map */
    #map {
        height: 200px;
        
    }
</style>
{{-- ini link css untuk leaflet menampilkan loaksi --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <input type="hidden" id="lokasi">
            <div class="webcam-capture"></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            {{-- untuk mengecek jika lebih dari 1 melakukan absen maka berubah menjadi absen pulang --}}
            @if ($cek > 0)    
            <button id="takeabsen" class="btn btn-danger btn-block"><ion-icon name="camera-outline"></ion-icon>Absen Pulang</button>
            @else
            <button id="takeabsen" class="btn btn-block" style="background: #0f2e64;  color: white;"><ion-icon name="camera-outline"></ion-icon>Absen Masuk</button>
            @endif
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>
{{-- Notifikasi ketika melakukan absen
        1. notifikasi in -> absen jam_in
        2. notifikasi out -> absen jam_out
        3. radius -> mengecek jarak radius, jika keluar dari radius maka ada notifikasi radius
    --}}
    <audio id="notifikasi_in">
        <source src="{{asset('assets/sound/notifikasi_in.mp3')}}" type="audio/mpeg">
    </audio>
    <audio id="notifikasi_out">
        <source src="{{asset('assets/sound/notifikasi_out.mp3')}}" type="audio/mpeg">
    </audio>
    <audio id="radius_sound">
        <source src="{{asset('assets/sound/radius.mp3')}}" type="audio/mpeg">
    </audio>
@endsection

@push('myscript')
    <script>
        // ini untuk mengatur code notifikasi
         var notifikasi_in = document.getElementById('notifikasi_in');
         var notifikasi_out = document.getElementById('notifikasi_out');
         var radius_sound = document.getElementById('radius_sound');

        // ini untuk mengatur Webcam, height,widht,format image 'jpeg' dan kualitas kamera, paling bagus 100
         Webcam.set({
            height: 480
            ,width: 640
            ,image_format: 'jpeg'
            ,jpeg_quality: 80
        });

        // webcam.attach ketika diklik maka akan membaca lokasi kita berada
        Webcam.attach('.webcam-capture');
        // ini untuk mengambil value lokasi kita berda
        var lokasi = document.getElementById('lokasi');
        // ini untuk mengecek apakah geolocation kita kebaca atau tidak, di bikin 2 kondisi :
        // kondisi 1 successcallbackk maka nanti akan membaca loaksi kita, jarak, latitude, longitude dll
        // kondisi 2 errorcallback maka lokasi tidak kebaca / null
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }
        // ini pengaturan untuk lokasi jika berhasil
        function successCallback(position) {
            lokasi.value = position.coords.latitude + ","+ position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);
            var lokasi_kantor = "{{$lok_kantor->lokasi_kantor}}"; // lok_kantor mengambil dari controller presensi/create,
            // lokasi_kantor mengambil dari table konfigurasi_lokasi
            var lok = lokasi_kantor.split(",");
            var lat_kantor = lok[0]; // lok[0] ini adalah latitude array ke 0
            var long_kantor = lok[1]; // lok[1] ini adalah latitude array ke 1
            var radius = "{{$lok_kantor->radius}}";
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            var circle = L.circle([lat_kantor, long_kantor], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }
        function errorCallback() {
        }
        // ini konfigurasi ketika kita click absen masuk maka akan mengirim data dibawah
        // mengirim data gambar,jam dan lokasi
    $("#takeabsen").click(function(e) {
        Webcam.snap(function(uri) {
            image = uri;
        });
        var lokasi = $("#lokasi").val();
        $.ajax({
            type: 'POST'
            , url: '/presensi/store'
            , data: {
                _token: "{{ csrf_token() }}"
                , image: image
                , lokasi: lokasi
            }
            , cache: false
            // ketika success maka akan respond notifikasi in, berhasil absen masuk
            , success: function(respond) {
                var status = respond.split("|");
                if (status[0] == "success") {
                    if (status[2] == "in") {
                        notifikasi_in.play();
                    } else {
                        notifikasi_out.play();
                    }
                    Swal.fire({
                        title: 'Berhasil !'
                        , text: status[1]
                        , icon: 'success'
                    })
                    // waktu 4000 mksdnya adalah 4 detik
                    // /dashboard mksdnya ketika sdh 4 detik maka akan kembali ke halaman dashboard
                    setTimeout("location.href='/dashboard'", 4000);
                } else {
                    if (status[2] == "radius") {
                        radius_sound.play();
                    }
                    Swal.fire({
                        title: 'Error !'
                        , text: status[1]
                        , icon: 'error'
                    })
                }
            }
        });

    });
</script>
@endpush