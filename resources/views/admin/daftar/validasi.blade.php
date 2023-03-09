@extends('layout-admin.flat')
@section('title', 'Validasi SOP')
@section('isi')

<x-breadcrumb judul="Validasi SOP" item="Detail SOP" href="sopparu-{{$inputs->slug}}"/>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <i class="fas fa-bookmark"></i> {{$inputs->nama}}
                                    
                                </h4>
                                <small class="btn btn-info text-white">{{$inputs->jenisop}}</small><br>
                                <span class="text-muted">oleh {{$inputs->user->name}}</span><br>
                                <span class="text-muted">pada {{date('d F Y H:i', strtotime($inputs->created_at))}}</span><br>
                                
                                <div class="container-fluid">
                                <form class="form-material" method="post" action="/valsopbaru-{{$inputs->id}}" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="body table-responsive mt-5">
                                                    <table class="table stylish-table">
                                                        <tbody>
                                                            
                                                            @csrf
                                                            @if($inputs->jenisop == 'Usulan SOP Baru')
                                                            <tr>
                                                                <td>Nama</td>
                                                                <td>:</td>
                                                                <td>{{$inputs->nama}}
                                                                    <hr>
                                                                    <p style="color:red; font-size: 12px;">
                                                                        @foreach($validasis as $validasi)
                                                                        {{$validasi->nama}}
                                                                            --<i><u>{{$validasi->user->name}}</u>
                                                                            </i><br>
                                                                        @endforeach
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" name="nama" type="text">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kategori</td>
                                                                <td>:</td>
                                                                <td>{{$inputs->kategori}}
                                                                    <hr>    
                                                                    <p style="color:red; font-size: 12px;">
                                                                        @foreach($vkategori as $kategori)
                                                                        {{$kategori->kategori}}
                                                                            --<i><u>{{$kategori->user->name}}</u>
                                                                            </i><br>
                                                                        @endforeach
                                                                    </p>
                                                                    </td>
                                                                <td>
                                                                    <select  class="form-select shadow-none"name="kategori" autocomplete="kategori">
                                                                        <option><option>
                                                                        @foreach ($kategoris as $kategori)
                                                                        <option>{{$kategori->kategori}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Keterkaitan</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @if($inputs->keterkaitans == '')
                                                                        <i>tidak ada</i>
                                                                    @else
                                                                        @foreach($inputs->keterkaitans as $keterkaitans)
                                                                            <span class="btn btn-primary">{{$keterkaitans}}</span>
                                                                        @endforeach
                                                                    @endif

                                                                        <hr>
                                                                        <p style="color:red; font-size: 11px;">
                                                                            @foreach($vketerkaitans as $keterkaitans)
                                                                                @foreach($keterkaitans->keterkaitans as $keterkaitan)        
                                                                                    <span class="btn-danger text-white" style=font-size:12px;>{{$keterkaitan}}</span>
                                                                                        --<i><u>{{$keterkaitans->user->name}}</u>
                                                                                        </i><br>
                                                                                @endforeach
                                                                                
                                                                                
                                                                            @endforeach
                                                                        </p>
                                                                   
                                                                </td>
                                                                <td>
                                                                <select multiple="multiple" class="form-select select2 shadow-none border-0 ps-0 form-control-line" name="keterkaitans[]" autocomplete="keterkaitans">
                                                                    @foreach ($seleketerkaitan as $input)
                                                                    <option>
                                                                        @if(isset($input->validasi))
                                                                        {{$input->validasi}}
                                                                        @else
                                                                        {{$input->nama}}
                                                                        @endif
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pelaksana</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @foreach($inputs->pelaksana as $pelaksana)
                                                                    <span class="btn btn-primary">{{$pelaksana}}</span>
                                                                    @endforeach

                                                                    <hr>
                                                                        <p style="color:red; font-size: 11px;">
                                                                            @foreach($vpelaksana as $vpelaksanas)
                                                                                @foreach($vpelaksanas->pelaksana as $valpelaksana)
                                                                                    <span class="btn-danger text-white" style=font-size:12px;>{{$valpelaksana}}</span>
                                                                                        --<i><u>{{$vpelaksanas->user->name}}</u>
                                                                                        </i><br>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </p>

                                                                </td>
                                                                <td>
                                                                <select multiple="multiple" class="form-select select2 shadow-none border-0 ps-0 form-control-line" name="pelaksana[]" autocomplete="pelaksana">
                                                                    @foreach ($pelaksanas as $pelaksana)
                                                                    <option>{{$pelaksana->pelaksana}}</option>
                                                                    @endforeach
                                                                </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kualifikasi</td>
                                                                <td>:</td>
                                                                <td>{{$inputs->kualifikasi}}

                                                                <hr>    
                                                                    <p style="color:red; font-size: 12px;">
                                                                        @foreach($vkualifikasi as $kualifikasi)
                                                                        {{$kualifikasi->kualifikasi}}
                                                                            --<i><u>{{$kualifikasi->user->name}}</u>
                                                                            </i><br>
                                                                        @endforeach
                                                                    </p>

                                                                </td>
                                                                <td>
                                                                        <input type="text" class="form-control" name="kualifikasi" autocomplete="kualifikasi">
                                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Waktu</td>
                                                                <td>:</td>
                                                                <td>{{$inputs->waktu}} menit

                                                                <hr>    
                                                                    <p style="color:red; font-size: 12px;">
                                                                        @foreach($vwaktu as $waktu)
                                                                        {{$waktu->waktu}} menit
                                                                            --<i><u>{{$waktu->user->name}}</u>
                                                                            </i><br>
                                                                        @endforeach
                                                                    </p>

                                                                </td>
                                                                <td>
                                                                <input id="waktu" type="text" class="form-control @error('waktu') is-invalid @enderror"  name="waktu"
                                                                    onkeyup="validAngka(this)" autocomplete="waktu" value="{{old('waktu')}}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Draf</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <a href="/sopbaru/{{$inputs->file}}">
                                                                    <i class="far fa-file-word" style="color:blue"></i>
                                                                    </a>

                                                                    <hr>    
                                                                    <p style="color:red; font-size: 12px;">
                                                                        @foreach($vfile as $file)
                                                                            <a href="/sopbaru/{{$file->file}}">
                                                                            <i class="far fa-file-word" style="color:blue"></i>
                                                                            </a>

                                                                        
                                                                            --<i><u>{{$file->user->name}}</u>
                                                                            </i><br>
                                                                        @endforeach
                                                                    </p>

                                                                </td>
                                                                <td>
                                                                    <input type="file" class="form-control" name="file" autocomplete="file">
                                                                </td>
                                                            </tr>
                                                            @elseif($inputs->jenisop == 'Usulan SOP Eksis')
                                                            <tr>
                                                                <td>Kategori</td>
                                                                <td>:</td>
                                                                <td>{{$inputs->kategori}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Keterkaitan</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @if($inputs->keterkaitans == '')
                                                                        <i>tidak ada</i>
                                                                    @else
                                                                        @foreach($inputs->keterkaitans as $keterkaitans)
                                                                            <span class="btn btn-primary">{{$keterkaitans}}</span>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pelaksana</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @foreach($inputs->pelaksana as $pelaksana)
                                                                    <span class="btn btn-primary">{{$pelaksana}}</span>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kualifikasi</td>
                                                                <td>:</td>
                                                                <td>{{$inputs->kualifikasi}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Waktu</td>
                                                                <td>:</td>
                                                                <td>{{$inputs->waktu}} menit</td>
                                                            </tr>
                                                            <tr>
                                                                <td>PDF</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <a href="/sopublish/{{$sopfinal->pdf}}" target="_blank">
                                                                        <i class="far fa-file-pdf" style="color:red"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @elseif($inputs->jenisop == 'Usulan Revisi SOP')
                                                            <th></th>
                                                            <th></th>
                                                            <th style="width:30%; background-color:tomato; color:white">Usulan Revisi SOP</th>
                                                            <th style="width:30%">SOP yang direvisi</th>
                                                            <th style="width:30%">Perubahan</th>
                                                            <tr>
                                                                <td>Nama</td>
                                                                <td>:</td>
                                                                <td>{{$inputs->nama}}
                                                                    <hr>
                                                                    <p style="color:red; font-size: 12px;">
                                                                        @foreach($validasis as $validasi)
                                                                        {{$validasi->nama}}
                                                                            --<i><u>{{$validasi->user->name}}</u>
                                                                            </i><br>
                                                                        @endforeach
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    @if(isset($rvalidasis))
                                                                    {{$rvalidasis->nama}}
                                                                    @else
                                                                    {{$r->nama}}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" name="nama" type="text">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kategori</td>
                                                                <td>:</td>
                                                                <td>{{$inputs->kategori}}
                                                                    <hr>    
                                                                    <p style="color:red; font-size: 12px;">
                                                                        @foreach($vkategori as $kategori)
                                                                        {{$kategori->kategori}}
                                                                            --<i><u>{{$kategori->user->name}}</u>
                                                                            </i><br>
                                                                        @endforeach
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    @if(isset($rkategori))
                                                                    {{$rkategori->kategori}}
                                                                    @else
                                                                    {{$r->kategori}}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <select  class="form-select shadow-none"name="kategori" autocomplete="kategori">
                                                                        <option><option>
                                                                        @foreach ($kategoris as $kategori)
                                                                        <option>{{$kategori->kategori}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Keterkaitan</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @if($inputs->keterkaitans == '')
                                                                        <i>tidak ada</i>
                                                                    @else
                                                                        @foreach($inputs->keterkaitans as $keterkaitans)
                                                                            <span class="btn btn-primary">{{$keterkaitans}}</span>
                                                                        @endforeach
                                                                    @endif
                                                                        <hr>
                                                                        <p style="color:red; font-size: 11px;">
                                                                            @foreach($vketerkaitans as $keterkaitans)
                                                                                @foreach($keterkaitans->keterkaitans as $keterkaitan)        
                                                                                    <span class="btn-danger text-white" style=font-size:12px;>{{$keterkaitan}}</span>
                                                                                        --<i><u>{{$keterkaitans->user->name}}</u>
                                                                                        </i><br>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </p>
                                                                </td>
                                                                <td>
                                                                    @if(isset($rketerkaitans))
                                                                        @foreach($rketerkaitans->keterkaitans as $keterkaitans)
                                                                            <span class="btn btn-primary">{{$keterkaitans}}</span>
                                                                        @endforeach
                                                                    @else
                                                                        @if($r->keterkaitans == '')
                                                                            <i>tidak ada</i>
                                                                        @else
                                                                            @foreach($r->keterkaitans as $keterkaitans)
                                                                                <span class="btn btn-primary">{{$keterkaitans}}</span>
                                                                            @endforeach
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                <select multiple="multiple" class="form-select select2 shadow-none border-0 ps-0 form-control-line" name="keterkaitans[]" autocomplete="keterkaitans">
                                                                    @foreach ($seleketerkaitan as $input)
                                                                    <option>
                                                                        @if(isset($input->validasi))
                                                                        {{$input->validasi}}
                                                                        @else
                                                                        {{$input->nama}}
                                                                        @endif
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pelaksana</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @foreach($inputs->pelaksana as $pelaksana)
                                                                    <span class="btn btn-primary">{{$pelaksana}}</span>
                                                                    @endforeach
                                                                    <hr>
                                                                        <p style="color:red; font-size: 11px;">
                                                                            @foreach($vpelaksana as $vpelaksanas)
                                                                                @foreach($vpelaksanas->pelaksana as $valpelaksana)
                                                                                    <span class="btn-danger text-white" style=font-size:12px;>{{$valpelaksana}}</span>
                                                                                        --<i><u>{{$vpelaksanas->user->name}}</u>
                                                                                        </i><br>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </p>
                                                                </td>
                                                                <td>
                                                                    @if(isset($rpelaksana))
                                                                        @foreach($rpelaksana->pelaksana as $pelaksana)
                                                                            <span class="btn btn-primary">{{$pelaksana}}</span>
                                                                        @endforeach
                                                                    @else
                                                                        @foreach($r->pelaksana as $pelaksana)
                                                                            <span class="btn btn-primary">{{$pelaksana}}</span>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                <select multiple="multiple" class="form-select select2 shadow-none border-0 ps-0 form-control-line" name="pelaksana[]" autocomplete="pelaksana">
                                                                    @foreach ($pelaksanas as $pelaksana)
                                                                    <option>{{$pelaksana->pelaksana}}</option>
                                                                    @endforeach
                                                                </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kualifikasi</td>
                                                                <td>:</td>
                                                                <td>{{$inputs->kualifikasi}}
                                                                <hr>    
                                                                    <p style="color:red; font-size: 12px;">
                                                                        @foreach($vkualifikasi as $kualifikasi)
                                                                        {{$kualifikasi->kualifikasi}}
                                                                            --<i><u>{{$kualifikasi->user->name}}</u>
                                                                            </i><br>
                                                                        @endforeach
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    @if(isset($rkualifikasi))
                                                                    {{$rkualifikasi->kualifikasi}}
                                                                    @else
                                                                    {{$r->kualifikasi}}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="kualifikasi" autocomplete="kualifikasi">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Waktu</td>
                                                                <td>:</td>
                                                                <td>{{$inputs->waktu}} menit
                                                                <hr>    
                                                                    <p style="color:red; font-size: 12px;">
                                                                        @foreach($vwaktu as $waktu)
                                                                        {{$waktu->waktu}} menit
                                                                            --<i><u>{{$waktu->user->name}}</u>
                                                                            </i><br>
                                                                        @endforeach
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    @if(isset($rwaktu))
                                                                    {{$rwaktu->waktu}}
                                                                    @else
                                                                    {{$r->waktu}}
                                                                    @endif    
                                                                    menit
                                                                </td>
                                                                <td>
                                                                <input id="waktu" type="text" class="form-control @error('waktu') is-invalid @enderror"  name="waktu"
                                                                    onkeyup="validAngka(this)" autocomplete="waktu" value="{{old('waktu')}}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Draf</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <a href="/sopbaru/{{$inputs->file}}">
                                                                        <i class="far fa-file-word" style="color:blue"></i>
                                                                    </a>
                                                                    <hr>    
                                                                    <p style="color:red; font-size: 12px;">
                                                                        @foreach($vfile as $file)
                                                                            <a href="/sopbaru/{{$file->file}}">
                                                                            <i class="far fa-file-word" style="color:blue"></i>
                                                                            </a>
                                                                            --<i><u>{{$file->user->name}}</u>
                                                                            </i><br>
                                                                        @endforeach
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    @if(isset($rfile))
                                                                    <a href="/sopbaru/{{$rfile->file}}">
                                                                        <i class="far fa-file-word" style="color:blue"></i>
                                                                    </a>
                                                                    @else
                                                                    <a href="/sopbaru/{{$r->file}}">
                                                                        <i class="far fa-file-word" style="color:blue"></i>
                                                                    </a>
                                                                    @endif    
                                                                    
                                                                </td>
                                                                <td>
                                                                    <input type="file" class="form-control" name="file" autocomplete="file">
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <span>Dengan ini saya nyatakan bahwa usulan ini:</span>
                                            <div>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input id="truo" type="radio" name="validasi" value=1 checked>
                                                        <label for="truo">Disetujui &emsp;
                                                            @if($inputs->jenisop == 'Usulan SOP Baru')
                                                                (dengan atau tanpa perubahan)
                                                            @endif
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input id="falso" type="radio" name="validasi" value=0>
                                                        <label for="falso">Ditolak</label>
                                                    </div>
                                                    <textarea name="keterangan" class="textinputo" placeholder="Catatan penolakan"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                        @if($inputs->jenisop != 'Usulan SOP Eksis')
                                            <span>
                                            Ketik perubahan pada kolom sebelah kanan terhadap usulan awal.
                                            <span style="color:red; font-size: 13px;">Warna merah merupakan catatan validator bukan usulan awal.</span>
                                            Kosongkan jika tidak ada perubahan</span><p></p>
                                        @endif
                                            <input type="submit" class="btn btn-success text-white" name="validasitom" value="Validasi">
                                            
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
