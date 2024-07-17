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
            <div class="col-6">
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
                        <form action="/konfigurasi/updatelokasikantor" method="POST">
                            @csrf
                           <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-current-location" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M12 12m-8 0a8 8 0 1 0 16 0a8 8 0 1 0 -16 0" /><path d="M12 2l0 2" /><path d="M12 20l0 2" /><path d="M20 12l2 0" /><path d="M2 12l2 0" /></svg>
                                        </span>
                                        <input type="text" id="lokasi_kantor" name="lokasi_kantor" value="{{$lok_kantor->lokasi_kantor}}" class="form-control" placeholder="Ketik Lokasi Kantor Anda">
                                      </div>
                                </div>
                            </div>
                           </div>
                           <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-radar-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44" /><path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14" /><path d="M12 12v9" /></svg>
                                        </span>
                                        <input type="text" id="radius" name="radius" value="{{$lok_kantor->radius}}" class="form-control" placeholder="Ketik Radius Anda">
                                      </div>
                                </div>
                            </div>
                           </div>
                           <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>Update</button>
                            </div>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection