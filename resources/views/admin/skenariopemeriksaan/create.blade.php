@extends('layout-admin.flat')
@section('title', 'Tambah Skenario Pemeriksaan')
@section('isi')
<x-breadcrumb judul="Tambah Skenario Pemeriksaan" item="Skenario Pemeriksaan" href=""/>
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-8 col-xlg-9 col-md-7">
                      <div class="card">
                          <div class="card-body">
                              <form class="form-horizontal form-material mx-2" method="post" action="/skenario">
                                    @csrf
                                    
                                    <div class="form-group row">
                                        <label for="kategori" class="col-md-4 col-form-label text-md-right">Nama Skenario/ Kategori</label>
                                        <div class="col-md-6">
                                            <select id="kategori" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('kategori') is-invalid @enderror" name="kategori" autocomplete="kategori" autofocus>
                                                <option value="">{{old('kategori')}} </option>
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
                                        <label for="level1" class="col-md-4 col-form-label text-md-right">Validator Level 1</label>
                                        <div class="col-md-6">
                                            <select id="level1" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('level1') is-invalid @enderror" name="level1" autocomplete="level1" autofocus>
                                                <option value="">{{old('level1')}} </option>
                                                @foreach ($jabatans as $jabatan)
                                                <option>{{$jabatan->jabatan}}</option>
                                                @endforeach                                                
                                            </select>
                                            @error('level1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <label for="level2" class="col-md-4 col-form-label text-md-right">Validator Level 2</label>
                                        <div class="col-md-6">
                                            <select id="level2" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('level2')
                                            is-invalid @enderror" name="level2" autocomplete="level2" autofocus>
                                                <option value="">{{old('level2')}} </option>
                                                @foreach ($jabatans as $jabatan)
                                                <option>{{$jabatan->jabatan}}</option>
                                                @endforeach                                                
                                            </select>
                                            @error('level2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="level3" class="col-md-4 col-form-label text-md-right">Validator Level 3</label>
                                        <div class="col-md-6">
                                            <select id="level3" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('level3')
                                            is-invalid @enderror" name="level3" autocomplete="level3" autofocus>
                                                <option value="">{{old('level3')}} </option>
                                                @foreach ($jabatans as $jabatan)
                                                <option>{{$jabatan->jabatan}}</option>
                                                @endforeach                                                
                                            </select>
                                            @error('level3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="level4" class="col-md-4 col-form-label text-md-right">Validator Level 4</label>
                                        <div class="col-md-6">
                                            <select id="level4" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('level4')
                                            is-invalid @enderror" name="level4" autocomplete="level4" autofocus>
                                                <option value="">{{old('level4')}} </option>
                                                @foreach ($jabatans as $jabatan)
                                                <option>{{$jabatan->jabatan}}</option>
                                                @endforeach                                                
                                            </select>
                                            @error('level4')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="level5" class="col-md-4 col-form-label text-md-right">Validator Level 5</label>
                                        <div class="col-md-6">
                                            <select id="level5" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('level5')
                                            is-invalid @enderror" name="level5" autocomplete="level5" autofocus>
                                                <option value="">{{old('level5')}} </option>
                                                @foreach ($jabatans as $jabatan)
                                                <option>{{$jabatan->jabatan}}</option>
                                                @endforeach                                                
                                            </select>
                                            @error('level5')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="level6" class="col-md-4 col-form-label text-md-right">Validator Level 6</label>
                                        <div class="col-md-6">
                                            <select id="level6" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('level6')
                                            is-invalid @enderror" name="level6" autocomplete="level6" autofocus>
                                                <option value="">{{old('level6')}} </option>
                                                @foreach ($jabatans as $jabatan)
                                                <option>{{$jabatan->jabatan}}</option>
                                                @endforeach                                                
                                            </select>
                                            @error('level6')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <p>Validator level diisi sesuai kebutuhan. Kosongkan selebihnya</p>

                                    <div class="form-group">
                                        <div class="col-sm-12 d-flex">
                                            
                                            <input type="submit" name="kirim" value="Simpan" class="btn btn-success mx-auto mx-md-0 text-white">
                                        </div>
                                    </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
@endsection
