{{-- halaman karyawan untuk mengecek data histori setiap bulannya
    1. jika data absen kosong, dibuatkan kondisi Dibawah ini!!
    --}}

@if ($histori->isEmpty() )
    <div class="alert alert-warning">
        <p>Data Absensi Kosong, Silahkan Pilih Bulan dan Tahun Kembali</p>
    </div>
@endif
@foreach ($histori as $d)
<ul class="listview image-listview">
    <li>
        <div class="item">
       {{-- semua penyimpanan foto absensi ada di 'uploads/absensi' 
            $d->foto_in berdasarkan dari database
       --}}
       @php
            $path = Storage::url('uploads/absensi/' . $d->foto_in);
        @endphp
            <div class="in">
                <div>
                   <b>{{date("d-m-Y",strtotime($d->tgl_presensi))}}</b>|
                </div>
                <img src="{{url($path)}}" alt="image" class="image">
                <span class="badge badge-success {{$d->jam_in <= "08:30" ? "bg-success" : "bg-danger"}}">{{$d->jam_in}}</span>
                <img src="{{url($path)}}" alt="image" class="image">
                <span class="badge badge-primary">{{$d->jam_out}}</span>
            </div>
        </div>
    </li>    
</ul>
@endforeach