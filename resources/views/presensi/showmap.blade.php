{{-- show map ini adalah untuk menampilkan lokasi  secara otomatis setelah melakukan absen 
        dan bisa dilihat pada halaman admin monitoring, per karyawan terlihat lokasi dan nama
    --}}
{{-- script yang dibawah ini copy dari link web leaflet.js
    langkah2 nya tinggal ikuti pertahap dari atas kebawah.
    --}}
<style>
    #map { height: 250px; }
</style>
<div id="map"></div>
<script>
    var lokasi = "{{$presensi->lokasi_in}}"; //ini mengambil dari database, table konfigurasi_lokasi
    var lok = lokasi.split(',');
    var latitude = lok[0];
    var longitude = lok[1];
    // var map ini untuk melakukan set latitude dan longitude, 
    // dan 18 itu jarak perbesar atau perkecil radius
    var map = L.map('map').setView([latitude,longitude], 18);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
var marker = L.marker([latitude, longitude]).addTo(map);
// latitude dan longitude kantor
var circle = L.circle([-6.952095099461646, 107.66137351722945], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 20
    }).addTo(map);

var popup = L.popup()
    .setLatLng([latitude, longitude])
    .setContent("{{$presensi->nama_lengkap}}")
    .openOn(map);

</script>