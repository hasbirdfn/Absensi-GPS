{{-- halaman admin izinsakit --}}
@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            {{$title}}
          </div>
          <h2 class="page-title">
            {{$title}}
          </h2>
        </div>
      </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
              {{-- form action untuk mengambik data izin, dihalaman admin pada fitur dataizinsakit  --}}

                <form action="/presensi/izinsakit" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-month" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
                                </span>
                                <input type="text" id="dari" name="dari" value="{{Request('dari')}}" class="form-control" placeholder="Dari">
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-month" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
                                </span>
                                <input type="text" id="sampai" name="sampai" value="{{Request('sampai')}}" class="form-control" placeholder="Sampai">
                              </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-3">
                          <div class="input-icon mb-3">
                              <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-scan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 12l14 0" /></svg>
                              </span>
                              <input type="text" id="nik" name="nik" value="{{Request('nik')}}" class="form-control" placeholder="NIK">
                            </div>
                      </div>
                      <div class="col-3">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                            </span>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{Request('nama_lengkap')}}" class="form-control" placeholder="Nama Karyawan">
                          </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">

                        {{-- ini adalah option status ada 3 keterangan --}}
                        <select name="status_approved" id="status_approved" class="form-control">
                          <option value="">Pilih Status</option>
                          <option value="0"{{Request('status_approved') === '0' ? 'selected'  : ''}}>Menunggu</option>
                          <option value="1" {{Request('status_approved') == 1 ? 'selected' : ''}}>Disetujui</option>
                          <option value="2" {{Request('status_approved') == 2 ? 'selected' : ''}}>Ditolak</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>Cari Data</button>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
               <table class="table table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Status Approved</th>
                    <th>Aksi</th>
                </tr>
            </thead>
               <tbody>
               @foreach ($izinsakit as $d)
                   <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{date('d-m-Y', strtotime($d->tgl_izin))}}</td>
                    <td>{{$d->nik}}</td>
                    <td>{{$d->nama_lengkap}}</td>
                    <td>{{$d->jabatan}}</td>
                    <td>{{$d->status == "i" ? "Izin" : "Sakit" }}</td>
                    <td>{{$d->keterangan}}</td>
                    <td>
                        @if ($d->status_approved == 1)
                            <span class="badge bg-success" style="color:white;">Disetujui</span>
                            @elseif ($d->status_approved == 2)
                            <span class="badge bg-danger" style="color:white;">Ditolak</span>
                            @else
                            <span class="badge bg-warning" style="color:white;">Menunggu</span>

                            @endif
                    </td>
                    <td>
                        @if ($d->status_approved == 0)
                        <a href="#" class="btn btn-sm btn-primary" id="approve" id_izinsakit="{{$d->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-external-link" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" /><path d="M11 13l9 -9" /><path d="M15 4h5v5" /></svg>
                        </a>    
                        @else
                        <a href="/presensi/{{$d->id}}/batalkanizinsakit" class="btn btn-sm btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" /><path d="M9 9l6 6m0 -6l-6 6" /></svg>Batalkan
                        </a>
                        @endif
                        
                    </td>
                </tr>
               @endforeach
               </tbody>
              </table>
              {{$izinsakit->links('vendor.pagination.bootstrap-5')}}
            </div>
        </div>
    </div>
</div>

{{-- modal izin sakit tambah, pada halaman admin fitur dataizinsakit--}}
<div class="modal modal-blur fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Data Izin / Sakit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/presensi/approveizinsakit" method="POST">
                @csrf
                <input type="hidden" id="id_izinsakit_form" name="id_izinsakit_form">
                <div class="row">
                    <div class="col-12">
                    <div class="form-group">
                        <select name="status_approved" id="status_approved" class="form-select">
                            <option value="1">Disetujui</option>
                            <option value="2">Ditolak</option>
                        </select>
                    </div>                        
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-12">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>Submit</button>
                      </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection

{{-- jquery ketika melakukan click button, ini fungsi untuk memunculkan show popup dan datepciker --}}
@push('myscript')
    <script>
        $(function() {
            $("#approve").click(function(e) {
                e.preventDefault();
                var id_izinsakit = $(this).attr("id_izinsakit");
                $("#id_izinsakit_form").val(id_izinsakit);
                $("#modal-izinsakit").modal("show");
            });
            $("#dari, #sampai").datepicker({ 
              autoclose: true, 
              todayHighlight: true,
              format:'yyyy-mm-dd'
            });
        });
    </script>
@endpush