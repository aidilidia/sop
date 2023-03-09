@extends('layout-admin.flat')
@section('title', 'Tambah Pengguna')
@section('isi')
<x-breadcrumb judul="Tambah Pengguna" item="Pengguna" href="" />
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-8 col-xlg-9 col-md-7">
                      <div class="card">
                          <div class="card-body">
                              <form class="form-horizontal form-material mx-2" method="post" action="/pengguna">
                                @csrf
                                <x-input field="name" label="Nama tanpa gelar" type="text"/>
                                <x-input field="nip" label="NIP" type="text"/>
                                
                                <div class="form-group row">
                                    <label for="jabatan" class="col-md-4 col-form-label text-md-right">Jabatan</label>
                                    <div class="col-md-6">
                                        <select id="jabatan" class="form-select shadow-none border-0 ps-0 form-control-line @error('jabatan') is-invalid @enderror" name="jabatan" autocomplete="jabatan" autofocus required>
                                            <option></option>
                                            @foreach ($pelaksanas as $pelaksana)
                                            <option>{{$pelaksana->pelaksana}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="jab_atasan" class="col-md-4 col-form-label text-md-right">Jabatan Atasan</label>
                                    <div class="col-md-6">
                                        <select id="jab_atasan" class="form-select shadow-none border-0 ps-0 form-control-line @error('jab_atasan') is-invalid @enderror" name="jab_atasan" autocomplete="jab_atasan" autofocus required>
                                            <option></option>
                                            @foreach ($pelaksanas as $pelaksana)
                                            <option>{{$pelaksana->pelaksana}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="level" class="col-md-4 col-form-label text-md-right">Level</label>
                                    <div class="col-md-6">
                                        <select id="level" class="form-select shadow-none border-0 ps-0 form-control-line @error('level') is-invalid @enderror" name="level" autocomplete="level" autofocus required>
                                            @foreach ($levels as $level)
                                            <option>{{$level->level}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <x-input field="email" label="Email" type="email"/>

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
