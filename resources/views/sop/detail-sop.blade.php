@extends('layout-sop.layout')
@section('title', 'Detail SOP')
@section('konten')

    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Detail SOP</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
        <form action="/sopublish/{{$sopfinal->pdf}}" target="_blank">
        @csrf
          <button class="tomcoret"><span>Download pdf</span></button>
        </form>
      </div><!-- /.container-fluid -->
    </div>

    <div class="content">
      <div class="container">

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width:400px">Meta</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tr>
                    <td>Nomor SOP</td>
                    <td>{{$nomor->nomor}}</td>
                  </tr>
                  <tr>
                    <td>Judul</td>
                    <td>
                      @if($validasis == NULL)
                          {{$input->nama}}
                      @else
                          {{$validasis->nama}}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Tanggal Pembuatan</td>
                    <td>
                      @if($input->jenisop == 'Usulan SOP Eksis')
                        {{date('d F Y', strtotime($input->pembuatan))}}
                      @elseif($input->jenisop == 'Usulan SOP Baru' || 'Usulan Revisi SOP')
                        {{date('d F Y', strtotime($nomor->created_at))}}      
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Tanggal Revisi</td>
                    <td>
                      @if($input->jenisop == 'Usulan SOP Eksis' || 'Usulan SOP Baru')
                        -
                      @elseif($input->jenisop == 'Usulan Revisi SOP')
                        {{date('d F Y', strtotime($nomor->created_at))}} 
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Tanggal Efektif</td>
                    <td>
                      @if($input->jenisop == 'Usulan SOP Eksis')
                        @if($validasis == NULL)
                          {{date('d F Y', strtotime($input->created_at))}}
                        @else
                          {{date('d F Y', strtotime($validasis->created_at))}}
                        @endif  
                      
                      @elseif($input->jenisop == 'Usulan SOP Baru' || 'Usulan Revisi SOP')
                        {{date('d F Y', strtotime($nomor->created_at))}}      
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Kategori</td>
                      <td>
                        @if($vkategori == NULL)
                            {{$input->kategori}}
                        @else
                            {{$vkategori->kategori}}
                        @endif
                      </td>
                  </tr>
                  <tr>
                    <td>Keterkaitan</td>
                    <td>
                      @if($input->keterkaitans == '')
                          <i>tidak ada</i>
                      @elseif($vketerkaitans == NULL)
                          @foreach($input->keterkaitans as $keterkaitans)
                              <li style="list-style-type: circle;">{{$keterkaitans}}</li>
                          @endforeach
                      @else
                          @foreach($vketerkaitans->keterkaitans as $keterkaitan)        
                              <li style="list-style-type: circle;">{{$keterkaitan}}</li>
                          @endforeach
                      @endif
                  </td>
                  </tr>
                  <tr>
                    <td>Pelaksana</td>
                    <td>
                      @if($vpelaksana == NULL)
                          @foreach($input->pelaksana as $pelaksana)
                              <li style="list-style-type: circle;">{{$pelaksana}}</li>
                          @endforeach
                      @else
                          @foreach($vpelaksana->pelaksana as $valpelaksana)
                              <li style="list-style-type: circle;">{{$valpelaksana}}</li>
                          @endforeach
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Kualifikasi Pelaksana</td>
                    <td>
                      @if($vkualifikasi == NULL)
                          {{$input->kualifikasi}}
                      @else
                          {{$vkualifikasi->kualifikasi}}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Waktu yang diperlukan</td>
                    <td>
                      @if($vwaktu == NULL)
                          {{$input->waktu}}
                      @else
                          {{$vwaktu->waktu}}
                      @endif
                      menit
                    </td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>
                      
                      @if($noUbah == NULL)
                        Berlaku
                      @elseif(isset($diubah))
                        Tidak Berlaku
                      @else
                        Berlaku
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Riwayat</td>
                    <td>
                      @if(!$vrowUbah && !$vrowRevisi && !$rowRevisi)
                        -
                      @endif

                      @if($rowRevisi && !isset($vrowRevisi->nama))
                        <li style="list-style-type: circle;">
                          Merevisi {{$rowRevisi->nama}} nomor {{$noRevisi->nomor}}
                        </li>
                      @endif

                      @if(isset($vrowRevisi->nama))
                        <li style="list-style-type: circle;">
                          Merevisi {{$vrowRevisi->nama}} nomor {{$noRevisi->nomor}}
                        </li>
                      @endif

                      @if($noUbah)
                        <li style="list-style-type: circle;">
                          Direvisi oleh {{$vrowUbah}} nomor {{$noUbah->nomor}}
                        </li>
                      @endif
                    </td>
                  </tr>
                  <!-- <tr>
                    <td>Jumlah Tayang</td>
                    <td>1 kali</td>
                  </tr> -->
                </table>

              </div>
            </div>
          </div>
          <form action="/semua">
            <button class="tomcoret"><span>&nbsp;&nbsp;Ke daftar&nbsp;&nbsp; </span></button>
          </form>
          <br>
          <br>

        </div>
      </div>
    </div>
@endsection