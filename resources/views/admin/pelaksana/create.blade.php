@extends('layout-admin.flat')
@section('title', 'Tambah Pelaksana')
@section('isi')
<x-breadcrumb judul="Tambah Pelaksana SOP" item="Pelaksana" href=""/>
          <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-8 col-xlg-9 col-md-7">
                      <div class="card">
                          <div class="card-body">
                              <form class="form-horizontal form-material mx-2" method="post" action="/pelaksana">
                                    @csrf
                                    <x-input field="pelaksana" label="Pelaksana SOP/ Jabatan" type="text"/>

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
