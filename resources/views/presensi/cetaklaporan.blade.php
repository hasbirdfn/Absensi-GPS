{{-- Halaman cetaklaporan pdf, pada halaman admin --}}
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
<style>
@page {
     size: A4 
    }
 #title {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
    font-size: 18px;
    font-weight:bold;
 }

 .tabeldatakaryawan {
    margin-top: 40px;
 }
 .tabeldatakaryawan tr td {
    padding: 5px;
 }
 .tabelpresensi {
    width: 100%;
    margin-top: 20px;
 }
 .tabelpresensi tr th {
    border: 1px solid #131212;
    padding: 8px;
    color:white;
    background-color: #0f2e64; 
 }
 .tabelpresensi tr td {
    border: 1px solid #131212;
    padding: 5px;
    font-size: 12px;
 }
 .fotoin {
    width: 40px;
    height: 30px;
 }
 .fotoout {
    width: 40px;
    height: 30px;
 }
</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
    <?php
    function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
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
  <section class="sheet padding-10mm">
    <!-- Write HTML just like a web page -->
    <table style="width:100%">
        <tr>
            <td style="width: 30px">
                <img src="{{asset('assets/img/ibp.png')}}" alt="logo ibp" width="80" height="80">
            </td>
            <td>
                <span id="title">
                    LAPORAN PRESENSI KARYAWAN<br>
                    PERIODE {{ strtoupper($namabulan[$bulan])}} {{$tahun}}<br>
                    PT. IBP CONSULTANT<br>
                </span>
                <span><i>Jl. Rancabolang No.239 A, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286</i></span>
            </td>
        </tr>
    </table>
    <div class="card">
        <div class="card-body">
            <table class="tabeldatakaryawan">
                <tr>
                    <td rowspan="7">
                        @php
                            $path = Storage::url('uploads/karyawan/' . $karyawan->foto);
                        @endphp
                        <img src="{{url($path)}}" alt="" width="100" height="150">
                    </td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{$karyawan->nik}}</td>
                </tr>
                <tr>
                    <td>Nama Karyawan</td>
                    <td>:</td>
                    <td>{{$karyawan->nama_lengkap}}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>{{$karyawan->jabatan}}</td>
                </tr>
                <tr>
                    <td>Departemen</td>
                    <td>:</td>
                    <td>{{$karyawan->nama_dept}}</td>
                </tr>
                <tr>
                    <td>No Handphone</td>
                    <td>:</td>
                    <td>{{$karyawan->no_hp}}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{$karyawan->alamat}}</td>
                </tr>
              </table>
        </div>
    </div>
    
    <table class="tabelpresensi">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Foto</th>
            <th>Jam Pulang</th>
            <th>Foto</th>
            <th>Keterangan</th>
            <th>Jumlah JamKerja</th>
        </tr>
        @foreach ($presensi as $d)
        @php
         $path_in = Storage::url('uploads/absensi/' . $d->foto_in);
         $path_out = Storage::url('uploads/absensi/' . $d->foto_out);
        $jamterlambat = selisih('08:30:00', $d->jam_in);
        @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{date("d-m-Y",strtotime($d->tgl_presensi))}}</td>
                <td>{{$d->jam_in}}</td>
                <td><img src="{{url($path_in)}}" alt="fotoin" class="fotoin"></td>
                <td>{{$d->jam_out != null ? $d->jam_out : 'Belum Absen'}}</td>
                <td>
                    @if ($d->jam_out != null)
                    <img src="{{url($path_out)}}" alt="fotoout" class="fotoout">
                    @else
                    <img src="{{asset('assets/img/nopoto.png')}}" alt="nopoto" class="fotoout">
                    @endif
                </td>
                <td>
                    @if ($d->jam_in > '08:30')
                    Terlambat {{$jamterlambat}}
                    @else
                    Tepat Waktu
                    @endif
                </td>
                <td>
                    @if ($d->jam_out != null)
                     @php
                         $jmljamkerja = selisih($d->jam_in,$d->jam_out);
                     @endphp
                     @else
                     @php
                         $jmljamkerja = 0;
                     @endphp
                    @endif
                    {{$jmljamkerja}}
                </td>
            </tr>
        @endforeach
    </table>
  </section>
</body>

</html>