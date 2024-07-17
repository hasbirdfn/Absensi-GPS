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
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                    @if (Session::get('success'))
                        <div class="alert alert-success">                       
                          {{Session::get('success')}}
                        </div>
                    @endif

                    @if (Session::get('warning'))
                        <div class="alert alert-warning">
                          {{Session::get('warning')}}
                        </div>
                    @endif
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <a href="#" class="btn btn-primary" id="btnTambahStatus">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M9 12h6" /><path d="M12 9v6" /></svg>Tambah Data</a>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-12">
                      <form action="/status" method="GET">
                        <div class="row">
                          <div class="col-10">
                            <div class="form-group">
                              <input type="text" name="nama_status" id="nama_status" class="form-control" placeholder="Nama Status" value="{{Request('nama_status')}}">
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                              Cari Data</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-12">
                      <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Status</th>
                                <th>Nama Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($status as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$d->kode_status}}</td>
                                    <td>{{$d->nama_status}}</td>
                                    <td>
                                        <div class="btn-group">
                                          <a href="#" class="edit btn btn-warning btn-sm" kode_status={{$d->kode_status}}><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                          </a>
                                          <form action="/status/{{$d->kode_status}}/delete" method="POST" style="margin-left: 5px">
                                          @csrf
                                          <a class="btn btn-danger btn-sm delete-confirm"> <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                                          </form>
                                        </div>
                                      </td>   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    </div>
                  </div>
              </div> 
            </div>
        </div>
    </div>
</div>

{{-- modal tambah --}}
<div class="modal modal-blur fade" id="modal-inputstatus" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/status/store" method="POST" id="frmStatus">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-scan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 12l14 0" /></svg>
                </span>
                <input type="text" id="kode_status" name="kode_status" value="" class="form-control" placeholder="Ketik Kode Status Anda">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                </span>
                <input type="text" id="nama_status" name="nama_status" value="" class="form-control" placeholder="Ketik Nama Status Anda">
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-12">
              <div class="form-group">
                <button type="submit" class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- modal edit --}}
<div class="modal modal-blur fade" id="modal-editstatus" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="loadeditform">
        
      </div>
    </div>
  </div>
</div>
@endsection


{{-- Halaman script ini untuk mengatur popup tambah,edit,hapus dan validasia --}}
@push('myscript')
  <script>
    $(function() {
      $("#btnTambahStatus").click(function() {
        $("#modal-inputstatus").modal("show");
      });
      $(".edit").click(function() {
        var kode_status = $(this).attr('kode_status');   
        $.ajax({
          type : 'POST',
          url : '/status/edit',
          cache: false,
          data : {
            _token : "{{csrf_token()}}",
            kode_status : kode_status
          },
          success : function(respond) {
            $("#loadeditform").html(respond);
          }
        });
        $("#modal-editstatus").modal("show");
      });

      $(".delete-confirm").click(function(e) {
        var form = $(this).closest('form');
        e.preventDefault();
        Swal.fire({
            title: "Apakah Anda Yakin Menghapus Data?",
            text: "Jika Ya, maka data akan terhapus permanent!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus Saja!"
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
              Swal.fire({
                title: "Deleted!",
                text: "Data Berhasil Dihapus.",
                icon: "success"
              });
            }
          });
        });
        $("#frmStatus").submit(function() { 
        var kode_status = $("#frmStatus").find("#kode_status").val();
        var nama_status = $("#frmStatus").find("#nama_status").val();
         
          if (kode_status == "") {
            Swal.fire({
              title: 'Warning!',
              text: 'Kode status harus diisi!',
              icon: 'warning',
              confirmButtonText: 'Ok'
            }).then((result)=> {
              $("#kode_status").focus();
            });
            return false;
          } else if (nama_status == ""){
            Swal.fire({
              title: 'Warning!',
              text: 'Status harus diisi!',
              icon: 'warning',
              confirmButtonText: 'Ok'
            }).then((result)=> {
              $("#nama_status").focus();
            });
            return false;
          }
        });
    });
  </script>
@endpush