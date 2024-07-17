{{-- halaman get presensi ini adalah data hasil monitoring absensi,
    mengambil data dari absen yang dilakukan karyawan setiap hari nya.

    halaman monitoring ini bisa dipantau perhari, secara klik langsung tanggal yang diinginkan

    --}}

<?php
//function ini fungsinya untuk menghitung selisih jam masuk dan jam keluar
// ada 2 parameter jam_masuk dan jam_keluar
    function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            // membagi string $jam_masuk menjadi tiga bagian (jam, menit, detik) dan menetapkan ke variabel $h, $m, dan $s.
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            //  Sama seperti code yang awak pertama, membagi string $jam_keluar menjadi tiga bagian (jam, menit, detik) dan menetapkan ke variabel $h, $m, dan $s.
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
        }
?>
@foreach ($presensi as $d)
{{-- buat folder path --}}
@php
    // kalo mau lihat hasil foto absen ada di folder storage/app/uploads/absensi
    // storage foto ada di uploads/absensi
    // storage foto karyawan ada di uploads/karyawan
    $foto_in = Storage::url('uploads/absensi/'. $d->foto_in);
    $foto_out = Storage::url('uploads/absensi/'. $d->foto_out);
@endphp
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$d->nik}}</td>
        <td>{{$d->nama_lengkap}}</td>
        <td>{{$d->nama_dept}}</td>
        <td>{{$d->jam_in}}</td>
        <td>
            <img src="{{url($foto_in)}}" class="avatar" alt="">
        </td>
        <td>{!!$d->jam_out != null ? $d->jam_out : '<span class="badge bg-danger" style="color:white;">Belum Absen</span>'!!}</td>
        <td>
            @if ($d->jam_out != null)
            <img src="{{url($foto_out)}}" class="avatar" alt="">
            @else
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor" /></svg>
            @endif
        </td>
        <td>
            @if ($d->jam_in >= "08:30")
            @php
            // masukin function selisih untuk menghitung jam masuk nya
                $jamterlambat = selisih('08:30:00',$d->jam_in);
            @endphp
                <span class="badge bg-danger" style="color:white;">Terlambat {{$jamterlambat}}</span>
            @else
            <span class="badge bg-success" style="color:white;">Tepat Waktu</span>
            @endif
        </td>
        <td>
            {{-- buatkan class tampilkanpeta --}}
            {{-- id itu adalah id dari table presensi --}}
            <a href="#" class="btn btn-primary tampilkanpeta" id="{{$d->id}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg></a>
        </td>
    </tr>
@endforeach

<script>
    $(function() {
        // function ini untuk menampilkan pop up peta lokasi dan nama kita.
        // jadi var id menampung value dari atribut/attr id dibawah
        $(".tampilkanpeta").click(function(e) {
            var id = $(this).attr("id");
            $.ajax({
                type:'POST',
                url: '/tampilkanpeta',
                data: {
                    _token: "{{csrf_token() }}",
                    id:id
                },
                cache:false,
                success:function(respond){
                    // #loadmap diambil dari halaman monitoring utk mengambil data/merespon
                    $("#loadmap").html(respond);
                }
            });
            $("#modal-tampilkanpeta").modal("show");
        });
    });
</script>