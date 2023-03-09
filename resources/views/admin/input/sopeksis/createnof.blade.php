@if($inputs->user_id == Auth::user()->id)
@extends('layout-admin.flat')
@if(isset($nomor))
    @section('title', 'Upload File PDF SOP')
@else
    @section('title', 'Beri Nomor SOP')
@endif
@section('isi')

@if(isset($nomor))
<x-breadcrumb judul="Upload File PDF SOP" item="Penerbitan SOP" href="/penerbitan"/>
@else
<x-breadcrumb judul="Beri Nomor SOP" item="Penerbitan SOP" href="/penerbitan"/>
@endif
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
                                @if($inputs->jenisop == 'Usulan SOP Baru')
                                    <span>dan telah mendapatkan persetujuan dengan data final sebagai berikut:</span>
                                @endif
                                
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
                                                            
                                                            @if($inputs->jenisop == 'Usulan SOP Baru')
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
                                                            <tr>
                                                                <td>Scan PDF sebelum diberi nomor</td>
                                                                <td>:</td>
                                                                <td>
                                                                    
                                                                    <a href="/soppdf/{{$terbits->filepdf}}" target="_blank">
                                                                        <i class="far fa-file-pdf" style="color:red"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @if(isset($nomor))
                                                            <tr style="background-color:LightGray;">
                                                                <td>Nomor</td>
                                                                <td>:</td>
                                                                <td>
                                                                    {{$nomor->nomor}}
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <hr> -->

                                        <div class="col-sm-6">

                                            @if(isset($nomor))
                                                <span>Upload PDF SOP eksis yang telah diberi nomor dan disahkan</span>
                                                <div>
                                                    <br>
                                                    <form class="form-material" method="post" action="/sopeksisf-{{$inputs->id}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="file" class="form-control" name="pdf" id="pdf" autofocus>
                                                        </div>
                                                        @error('pdf')
                                                        <span style="color:red" >
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                </div>
                                                    <input type="checkbox" id="cebox" onclick="chek()" name="terbit" class="btn btn-warning text-dark" >
                                                    <label for="cebox" style="font-family:Helvetica; color:grey">
                                                            Saya nyatakan bahwa PDF ini adalah SOP yang sedang efektif
                                                    </label>
                                                    <br>
                                                    <input type="submit" id="tombol" name="upload" class="btn btn-success text-dark" style="display:none" value="Upload PDF" >
                                                    </form>
                                            @else
                                                <span>
                                                    <!-- Berikut nomor otomatis untuk SOP ini, ubah jika diperlukan! -->
                                                    Silakan tulis nomor untuk SOP ini!
                                                </span>
                                                    <div>
                                                        <form class="form-material" method="post" action="/sopeksis-{{$inputs->id}}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="nomor" id="nomor" autofocus value="{{old('nomor')}}">
                                                            </div>
                                                            @error('nomor')
                                                            <span style="color:red" >
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                <input type="submit" name="beno" class="btn btn-warning text-dark" value="Beri nomor">
                                                        </form>
                                            @endif
                                        </div>

                                    </div>
                                    
                                </div>
                                           
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
@endsection

@else
    you lost in the echo

@endif
