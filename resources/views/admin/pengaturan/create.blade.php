@extends('layout-admin.flat')
@section('title', 'Tambah Level')
@section('isi')
<x-breadcrumb judul="Tambah Level User" item="Level" href=""/>
          <div class="container-fluid">

            <div class="row">
                  <div class="col-lg-8 col-xlg-9 col-md-7">
                      <div class="card">
                          <div class="card-body">
                              Minimal level terinput:
                              <ol>
                                  <li>Approval : pemberi keputusan menyetujui atau menolak</li>
                                  <li>Penerbit : penerbit SOP yang sudah disetujui approval</li>
                                  <li>User : pengusul SOP baru ataupun perubahan</li>
                              </ol>
                              Setiap level memiliki kapasitas untuk mengusulkan SOP baru ataupun usulan perubahan
                          </div>
                      </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-lg-8 col-xlg-9 col-md-7">
                      <div class="card">
                          <div class="card-body">
                              <form class="form-horizontal form-material mx-2" method="post" action="/level">
                                    @csrf
                                    <x-input field="level" label="Level" type="text"/>

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
