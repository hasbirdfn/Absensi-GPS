{{-- Hlaman Departemen untuk mengatur segala kebutuhan
  1. crud
  2. alert respond
  3. jqeury 
  4. poup dll
  --}}

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
                      {{-- alert untuk pesan success --}}
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
                      <a href="#" class="btn btn-primary" id="btnTambahDepartemen">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M9 12h6" /><path d="M12 9v6" /></svg>Tambah Data</a>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-12">
                      <form action="/departemen" method="GET">
                        <div class="row">
                          <div class="col-10">
                            <div class="form-group">
                              <input type="text" name="nama_dept" id="nama_dept" class="form-control" placeholder="Nama Departarmen" value="{{Request('nama_dept')}}">
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
                                <th>Kode Departemen</th>
                                <th>Nama Departemen</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departemen as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$d->kode_dept}}</td>
                                    <td>{{$d->nama_dept}}</td>
                                    <td>
                                        <div class="btn-group">
                                          <a href="#" class="edit btn btn-warning btn-sm" kode_dept={{$d->kode_dept}}><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                          </a>
                                          {{-- form action untuk delete berdasrakan kode_Dept--}}
                                          <form action="/departemen/{{$d->kode_dept}}/delete" method="POST" style="margin-left: 5px">
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
<div class="modal modal-blur fade" id="modal-inputdepartemen" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Departemen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/departemen/store" method="POST" id="frmDepartemen">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-scan" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 12l14 0" /></svg>
                </span>
                <input type="text" id="kode_dept" name="kode_dept" value="" class="form-control" placeholder="Ketik Kode Departemen Anda">
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
                <input type="text" id="nama_dept" name="nama_dept" value="" class="form-control" placeholder="Ketik Nama Departemen Anda">
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
<div class="modal modal-blur fade" id="modal-editdepartemen" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Departemen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      {{-- kegunaan id= loadeditform untuk memanggil respond --}}
      <div class="modal-body" id="loadeditform">
        
      </div>
    </div>
  </div>
</div>
@endsection
@push('myscript')
  <script>
    // modal tambah untuk tambah data departemen
    $(function() {
      $("#btnTambahDepartemen").click(function() {
        $("#modal-inputdepartemen").modal("show");
      });
      // modal edit untuk edit data departemen
      $(".edit").click(function() {
        var kode_dept = $(this).attr('kode_dept');   
        $.ajax({
          type : 'POST',
          url : '/departemen/edit',
          cache: false,
          data : {
            _token : "{{csrf_token()}}",
            kode_dept : kode_dept
          },
          success : function(respond) {
            $("#loadeditform").html(respond);
          }
        });
        $("#modal-editdepartemen").modal("show");
      });
// ketika delete di clik, menampilkan alert hapus Swal fire
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
      $("#frmDepartemen").submit(function() { 
        var kode_dept = $("#frmDepartemen").find("#kode_dept").val();
        var nama_dept = $("#frmDepartemen").find("#nama_dept").val();
         
          if (kode_dept == "") {
            Swal.fire({
              title: 'Warning!',
              text: 'Kode Dept harus diisi!',
              icon: 'warning',
              confirmButtonText: 'Ok'
            }).then((result)=> {
              $("#kode_dept").focus();
            });
            return false;
          } else if (nama_dept == ""){
            Swal.fire({
              title: 'Warning!',
              text: 'Departemen harus diisi!',
              icon: 'warning',
              confirmButtonText: 'Ok'
            }).then((result)=> {
              $("#nama_dept").focus();
            });
            return false;
          }
        });
    });
  </script>
@endpush