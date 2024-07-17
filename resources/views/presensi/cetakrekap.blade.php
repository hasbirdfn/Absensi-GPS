{{-- Halaman cetak rekap untuk pdf dan excel, padahalaman admin --}}

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
    /* css untuk mengatur warna, ukuran, tr,td dll */
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
    border-collapse: collapse;
 }
 .tabelpresensi tr th {
    border: 1px solid #131212;
    padding: 8px;
    background-color: #dbdbdb; 
    font-size: 8px;
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
<body class="A4 landscape">
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
                    REKAP ABSENSI KARYAWAN<br>
                    PERIODE {{ strtoupper($namabulan[$bulan])}} {{$tahun}}<br>
                    PT. IBP CONSULTANT<br>
                </span>
                <span><i>Jl. Rancabolang No.239 A, Manjahlega, Kec. Rancasari, Kota Bandung, Jawa Barat 40286</i></span>
            </td>
        </tr>
    </table>

    <table class="tabelpresensi">
        <tr>
            <th rowspan="2">NIK</th>
            <th rowspan="2">Nama Karyawan</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">TH</th>
            <th rowspan="2">TT</th>
            <th rowspan="2">TS/I</th>
            <th rowspan="2">TJ</th>
        </tr>
        <tr>
            <?php
            for($i=1; $i <=31; $i++) {
                ?>
            <th>{{$i}}</th>
            <?php 
            }
            ?>
        </tr>
        @foreach ($rekap as $d)
        <tr>
            <td>{{"'". $d->nik . "'"}}</td>
            <td>{{$d->nama_lengkap}}</td>

            <?php 
            $totalhadir = 0;
            $totalterlambat = 0;
            for ($i = 1; $i <= 31; $i++) {
                $tgl = "tgl_" . $i;
                if (empty($d->$tgl)) {
                    $hadir = ['', ''];
                    $totalhadir += 0;
                } else {
                    $hadir = explode("-", $d->$tgl);
                    $totalhadir += 1;
                    // Check if the first part of the $hadir array is greater than "08:30:00"
                    if ($hadir[0] > "08:30:00") {
                        $totalterlambat += 1;
                    }
                }
            ?>
                <td>
                    <span style="color: {{ $hadir[0] > '08:30:00' ? 'red' : '' }}">{{$hadir[0]}}</span><br>
                    <span style="color: {{ $hadir[1] < '17:30:00' ? 'green' : '' }}">{{$hadir[0]}}</span>
                </td>
            <?php
            }
            
            ?>
            <td>{{$totalhadir}}</td>
            <td>{{$totalterlambat}}</td>
            </tr>
            
            @endforeach
    </table>
    <table width="100%" style="margin-top:100px">
        <tr>
            <td></td>
            <td style="text-align:center;">Bandung, {{date('d-m-Y')}}</td>
        </tr>
        <tr>
            <td style="text-align:center; vertical-align:bottom" height="100px">
                <u>Ilham Aprianta</u><br>
                <i>Human People And Service</i>
            </td>
            <td style="text-align:center; vertical-align:bottom">
                <u>Ibran Perdana</u><br>
                <i>Direktur</i>
            </td>
        </tr>
    </table>
  </section>
</body>

</html>