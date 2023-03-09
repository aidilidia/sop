@extends('layout-admin.flat')
@section('title', 'Detail SOP Terbit')
@section('isi')

<x-breadcrumb judul="Detail SOP Yang Sudah Diterbitkan" item="Daftar SOP Sudah Diterbitkan" href="/penerbitansuter"/>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                <i class="fas fa-bookmark"></i> 
                                    {{$inputs->nama}} 
                                    <small class="
                                    @if($inputs->jenisop == 'Usulan SOP Baru')
                                    text-info
                                    @elseif($inputs->jenisop == 'Input SOP Eksis')
                                    text-success
                                    @elseif($inputs->jenisop == 'Usulan Perubahan SOP')
                                    text-warning
                                    @endif
                                    ">&#8759; {{$inputs->jenisop}}</small>
                                </h4>
                                <span class="text-muted">diterbitkan pada {{date('d F Y H:i:s', strtotime($sopfinal->created_at))}}</span><br>
                                <!-- <span>dan telah mendapatkan persetujuan dengan data final sebagai berikut:</span> -->
                                
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="body table-responsive mt-5">
                                                    <table class="table stylish-table">
                                                    <tbody>
                                                            
                                                            
                                                            <tr>
                                                                <td>Nama</td>
                                                                <td>
                                                                    @if($validasis == NULL)
                                                                        {{$inputs->nama}}
                                                                    @else
                                                                        {{$validasis->nama}}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nomor</td>
                                                                <td>
                                                                    {{$nomor->nomor}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tanggal</td>
                                                                <td>
                                                                    {{date('d F Y', strtotime($nomor->created_at))}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kategori</td>
                                                                <td>
                                                                    @if($vkategori == NULL)
                                                                        {{$inputs->kategori}}
                                                                    @else
                                                                        {{$vkategori->kategori}}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Keterkaitan</td>
                                                                <td>
                                                                    @if($inputs->keterkaitans == '')
                                                                        <i>tidak ada</i>
                                                                    @elseif($vketerkaitans == NULL)
                                                                        @foreach($inputs->keterkaitans as $keterkaitans)
                                                                            <span class="btn btn-primary">{{$keterkaitans}}</span>
                                                                        @endforeach
                                                                    @else
                                                                        @foreach($vketerkaitans->keterkaitans as $keterkaitan)        
                                                                            <span class="btn btn-primary">{{$keterkaitan}}</span>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pelaksana</td>
                                                                <td>
                                                                    @if($vpelaksana == NULL)
                                                                        @foreach($inputs->pelaksana as $pelaksana)
                                                                            <span class="btn btn-primary">{{$pelaksana}}</span>
                                                                        @endforeach
                                                                    @else
                                                                        @foreach($vpelaksana->pelaksana as $valpelaksana)
                                                                            <span class="btn btn-primary">{{$valpelaksana}}</span>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kualifikasi</td>
                                                                <td>
                                                                    @if($vkualifikasi == NULL)
                                                                        {{$inputs->kualifikasi}}
                                                                    @else
                                                                        {{$vkualifikasi->kualifikasi}}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Waktu</td>
                                                                <td>
                                                                    @if($vwaktu == NULL)
                                                                        {{$inputs->waktu}}
                                                                    @else
                                                                        {{$vwaktu->waktu}}
                                                                    @endif
                                                                    menit
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Scan PDF final</td>
                                                                <td>
                                                                    <a href="/sopublish/{{$sopfinal->pdf}}" target="_blank">
                                                                        <i class="far fa-file-pdf" style="color:red"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
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
                </div>
            </div>
@endsection
