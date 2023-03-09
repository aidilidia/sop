@extends('layout-admin.flat')
@section('title', 'Upload File PDF SOP')
@section('isi')

<x-breadcrumb judul="Upload File PDF SOP" item="Penerbitan SOP" href="/penerbitan"/>
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
                                <span class="text-muted">diusulkan pada {{date('d F Y H:i', strtotime($inputs->created_at))}}</span><br>
                                <span>dan telah mendapatkan persetujuan dengan data final sebagai berikut:</span>
                                
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="body table-responsive mt-5">
                                                    <table class="table stylish-table">
                                                    <tbody>
                                                            
                                                            
                                                            <tr>
                                                                <td>Nama</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @if($validasis == NULL)
                                                                        {{$inputs->nama}}
                                                                    @else
                                                                        {{$validasis->nama}}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kategori</td>
                                                                <td>:</td>
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
                                                                <td>:</td>
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
                                                                <td>:</td>
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
                                                                <td>:</td>
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
                                                                <td>:</td>
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
                                                                <td>Draf</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @if($vfile == NULL)
                                                                        
                                                                    <a href="/sopbaru/{{$inputs->file}}">
                                                                    <i class="far fa-file-word" style="color:blue"></i>
                                                                    </a>
                                                                    @else
                                                                    <a href="/sopbaru/{{$vfile->file}}">
                                                                    <i class="far fa-file-word" style="color:blue"></i>
                                                                    </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <hr> -->

                                        <div class="col-sm-6">
                                            <span>Pastikan draf sudah sesuai dengan isian,
                                                <br> selanjutnya upload file PDF OCR sebelum disahkan dan belum diberi nomor!
                                             </span>
                                            <div>
                                                <br>
                                                <form class="form-material" method="post" action="/penerbitan-{{$inputs->id}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="file" class="form-control" name="filepdf" id="filepdf" autofocus>
                                                    </div>
                                                    @error('filepdf')
                                                    <span style="color:red" >
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                            </div>
                                            <input type="submit" name="upload" class="btn btn-danger text-white" value="Upload PDF">
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
