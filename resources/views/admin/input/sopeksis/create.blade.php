@extends('layout-admin.flat')
@section('title', 'Input Usulan SOP Eksis')
@section('isi')
<x-breadcrumb judul="Input Usulan SOP Eksis" item="Input" href="" />

          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-8 col-xlg-9 col-md-7">
                      <div class="card">
                          <div class="card-body">
                              <form class="form-horizontal form-material mx-2" method="post" action="/sopeksis" enctype="multipart/form-data">
                                @csrf
                                <x-input field="nama" label="Nama" type="text"/>
                                <x-input field="tanggal" label="Tanggal" type="date"/>
                                
                                <div class="form-group row">
                                    <label for="kategori" class="col-md-4 col-form-label text-md-right">Kategori</label>
                                    <div class="col-md-6">
                                        <select id="kategori" class="form-select shadow-none border-0 ps-0 form-control-line @error('kategori') is-invalid @enderror" name="kategori" autocomplete="kategori" autofocus>
                                            <option>{{ old('kategori') }}<option>
                                            @foreach ($kategoris as $kategori)
                                            <option>{{$kategori->kategori}}</option>
                                            @endforeach
                                        </select>
                                        
                                        @error('kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="keterkaitans" class="col-md-4 col-form-label text-md-right">Keterkaitan</label>
                                    <div class="col-md-6">
                                        <select id="keterkaitans" multiple="multiple" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('keterkaitans') is-invalid @enderror" name="keterkaitans[]" autocomplete="keterkaitans" autofocus>
                                            <option>{{ old('keterkaitans[]') }}<option>
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
                                    </div>
                                </div>

                                
                                <div class="form-group row">
                                    <label for="pelaksana" class="col-md-4 col-form-label text-md-right">Pelaksana</label>
                                    <div class="col-md-6">
                                        <select id="pelaksana" multiple="multiple" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('pelaksana') is-invalid @enderror" name="pelaksana[]" autocomplete="pelaksana" autofocus>
                                            <option>{{ old('pelaksana[]') }}<option>
                                            @foreach ($pelaksanas as $pelaksana)
                                            <option>{{$pelaksana->pelaksana}}</option>
                                            @endforeach
                                            
                                        </select>
                                        @error('pelaksana')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <x-input field="kualifikasi" label="Kualifikasi Pelaksana" type="text"/>

                                <div class="form-group row">
                                    <label for="waktu" class="col-md-4 col-form-label text-md-right">Waktu yang diperlukan (menit)</label>
                                    <div class="col-md-6">
                                        <input id="waktu" type="text" class="form-control @error('waktu') is-invalid @enderror"  name="waktu"
                                        onkeyup="validAngka(this)" autocomplete="waktu" value="{{old('waktu')}}" autofocus>
                                        @error('waktu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12 d-flex">
                                    <input type="submit" name="kirim" value="Kirim" class="btn btn-success mx-auto mx-md-0 text-white">
                                    </div>
                                </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
@endsection
