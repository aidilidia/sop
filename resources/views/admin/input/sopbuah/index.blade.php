@extends('layout-admin.flat')
@section('title', 'Input Usulan Revisi SOP')
@section('isi')
<x-breadcrumb judul="Input Usulan Revisi SOP" item="Input" href="/input" />

          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-8 col-xlg-9 col-md-7">
                      <div class="card">
                          <div class="card-body">
                              <form class="form-horizontal form-material mx-2" method="get" action="/sopbuahInput">
                                @csrf
                                <div class="form-group row">
                                    <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>
                                    <div class="col-md-6">
                                        <select id="nama"
                                         class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('nama') 
                                         is-invalid @enderror" name="nama" autocomplete="nama" autofocus>
                                            @foreach ($inputs as $input)
                                            <option>
                                                @if(isset($input->validasi))
                                                {{$input->validasi}}
                                                @else
                                                {{$input->nama}}
                                                @endif
                                            </option>
                                            @endforeach
                                        </select>

                                        @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12 d-flex">
                                    <input type="submit" name="pilih" value="Pilih" class="btn btn-warning mx-auto mx-md-0 text-dark">
                                    </div>
                                </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
@endsection
