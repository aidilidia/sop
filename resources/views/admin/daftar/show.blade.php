@extends('layout-admin.flat')
@section('title', 'Detail SOP')
@section('isi')

<x-breadcrumb judul="Detail SOP" item="Daftar" href="/daftar" />
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <i class="fas fa-bookmark"></i> 
                                    {{$input->nama}} 
                                    <small class="
                                    @if($input->jenisop == 'Usulan SOP Baru')
                                    text-info
                                    @elseif('$input->jenisop' == 'Input SOP Eksis')
                                    text-success
                                    @elseif('$input->jenisop' == 'Usulan Perubahan SOP')
                                    text-warning
                                    @endif
                                    ">&#8759; {{$input->jenisop}}</small>

                                </h4>
                                
                                <span class="text-muted">oleh {{$input->user->name}}</span> <br>
                                <span class="text-muted">pada {{date('d F Y H:i', strtotime($input->created_at))}}</span><br>
                                
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="body">
                                                    <table class="table stylish-table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Kategori</td>
                                                                <td>:</td>
                                                                <td>{{$input->kategori}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Keterkaitan</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @if($input->keterkaitans == '')
                                                                        <i>tidak ada</i>
                                                                    @else
                                                                        @foreach($input->keterkaitans as $keterkaitans)
                                                                            <span class="btn btn-primary">{{$keterkaitans}}</span>
                                                                        @endforeach
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pelaksana</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @foreach($input->pelaksana as $pelaksana)
                                                                    <span class="btn btn-primary">{{$pelaksana}}</span>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kualifikasi</td>
                                                                <td>:</td>
                                                                <td>{{$input->kualifikasi}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Waktu</td>
                                                                <td>:</td>
                                                                <td>{{$input->waktu}} menit</td>
                                                            </tr>
                                                            @if($input->jenisop != 'Usulan SOP Eksis')
                                                            <tr>
                                                                <td>Draf</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <a href="/sopbaru/{{$input->file}}">
                                                                    <i class="far fa-file-word" style="color:blue"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @else
                                                            <tr>
                                                                <td>PDF</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <a href="/sopublish/{{$sopfinal->pdf}}" target="_blank">
                                                                        <i class="far fa-file-pdf" style="color:red"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                        
                                        <p style="color: #fff">
                                           @if($kategori->level1 == Auth::user()->jabatan || 
                                               $kategori->level2 == Auth::user()->jabatan || 
                                               $kategori->level3 == Auth::user()->jabatan ||
                                               $kategori->level4 == Auth::user()->jabatan ||
                                               $kategori->level5 == Auth::user()->jabatan ||
                                               $kategori->level6 == Auth::user()->jabatan
                                               )

                                               {{$skenario = 'masuk sken'}}
                                                
                                                @foreach($validasis as $validasi)
                                                    @if($validasi->user->jabatan == Auth::user()->jabatan)
                                                        {{$pernahval = 'user ini sudah pernah menvalidasi'}}
                                                    @endif
                                                    
                                                    @if($validasi->user->level == 'Approval')
                                                        {{$setketua = 'ketua sudah menyetujui'}}
                                                    @endif
                                                @endforeach

                                           @endif

                                           <!-- tombol tampil jika
                                           0. jabatan user == jabatan pemeriksa -- $ pernahval
                                           1. belum diperiksa  oleh validator ! $ a
                                           2. belum disetujui KPTA ! $ setketua-->
                                         </p>

                                       

                                            <span class="
                                            @if(isset($setketua))
                                                text-success
                                            @elseif(30+$proses*10 > 30)
                                                text-warning
                                            @else
                                                text-info
                                            @endif
                                            ">Proses 
                                            @if(isset($setketua))
                                            100
                                            @else
                                            {{30+$proses*10}}
                                            @endif
                                            % selesai</span>
                                            <div class="progress">
                                                <div class="progress-bar
                                                @if(isset($setketua))
                                                    bg-success
                                                @elseif(30+$proses*10 > 30)
                                                    bg-warning
                                                @else
                                                    bg-info
                                                @endif
                                                " role="progressbar"
                                                    style="width: 
                                                        @if(isset($setketua))
                                                        100%
                                                        @else
                                                        {{30+$proses*10}}%
                                                        @endif
                                                    ; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>

                                            <div class="card-body">
                                                <div class="text-muted">
                                                    <ol type="I">
                                                        <li>Pengusulan <i class="fas fa-check text-success"></i></li>
                                                        <li>Pemeriksaan
                                                        
                                                            <ol type="1">
                                                                <li>{{$kategori->level1}}
                                                                    @foreach($validasis as $validasi)                                           
                                                                        @if($validasi->user->jabatan == $kategori->level1)
                                                                            @if($validasi->validasi == 1)
                                                                                <i class="fas fa-check text-success"></i>
                                                                            @elseif($validasi->validasi == 0)
                                                                                <i class="fas fa-times text-danger"></i>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach


                                                                </li>
                                                                <li>{{$kategori->level2}}
                                                                    @foreach($validasis as $validasi)                                           
                                                                        @if($validasi->user->jabatan == $kategori->level2)
                                                                            @if($validasi->validasi == 1)
                                                                                <i class="fas fa-check text-success"></i>
                                                                            @elseif($validasi->validasi == 0)
                                                                                <i class="fas fa-times text-danger"></i>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach

                                                                   
                                                                </li>
                                                                @isset($kategori->level3)    
                                                                <li>{{$kategori->level3}}
                                                                    @foreach($validasis as $validasi)                                           
                                                                        @if($validasi->user->jabatan == $kategori->level3)
                                                                            @if($validasi->validasi == 1)
                                                                                <i class="fas fa-check text-success"></i>
                                                                            @elseif($validasi->validasi == 0)
                                                                                <i class="fas fa-times text-danger"></i>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach

                                                                    
                                                                </li>
                                                                @endisset

                                                                @isset($kategori->level4)    
                                                                <li>{{$kategori->level4}}
                                                                    @foreach($validasis as $validasi)                                           
                                                                        @if($validasi->user->jabatan == $kategori->level4)
                                                                            @if($validasi->validasi == 1)
                                                                                <i class="fas fa-check text-success"></i>
                                                                            @elseif($validasi->validasi == 0)
                                                                                <i class="fas fa-times text-danger"></i>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach

                                                                </li>
                                                                @endisset

                                                                @isset($kategori->level5)    
                                                                <li>{{$kategori->level5}}
                                                                    @foreach($validasis as $validasi)                                           
                                                                        @if($validasi->user->jabatan == $kategori->level5)
                                                                            @if($validasi->validasi == 1)
                                                                                <i class="fas fa-check text-success"></i>
                                                                            @elseif($validasi->validasi == 0)
                                                                                <i class="fas fa-times text-danger"></i>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach

                                                                </li>
                                                                @endisset

                                                                @isset($kategori->level6)    
                                                                <li>{{$kategori->level6}}
                                                                    @foreach($validasis as $validasi)                                           
                                                                        @if($validasi->user->jabatan == $kategori->level6)
                                                                            @if($validasi->validasi == 1)
                                                                                <i class="fas fa-check text-success"></i>
                                                                            @elseif($validasi->validasi == 0)
                                                                                <i class="fas fa-times text-danger"></i>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach

                                                                </li>
                                                                @endisset
                                                            </ol>
                                                        </li>
                                                        <li>Persetujuan KPTA 
                                                                @foreach($validasis as $validasi)                                           
                                                                    @if($validasi->user->level == 'Approval')
                                                                        @if($validasi->validasi == 1)
                                                                            <i class="fas fa-check text-success"></i>
                                                                        @elseif($validasi->validasi == 0)
                                                                            <i class="fas fa-times text-danger"></i>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                    </ol>
                                                </div>
                                            </div>
                                            @if(isset($skenario))
                                                @if(!isset($setketua) && !isset($pernahval))
                                                        <a href="/valsopbaru-{{$input->slug}}" class="btn btn-warning text-dark">Buka Halaman Validasi</a>
                                                @endif
                                            @elseif(isset($validasi->user->level))
                                                @if(Auth::user()->level == 'Approval' && $validasi->user->level != 'Approval')
                                                        <a href="/valsopbaru-{{$input->slug}}" class="btn btn-warning text-dark">Buka Halaman Validasi</a>
                                                @endif
                                            @elseif(!isset($validasi->user->level))
                                                @if(Auth::user()->level == 'Approval')
                                                        <a href="/valsopbaru-{{$input->slug}}" class="btn btn-warning text-dark">Buka Halaman Validasi</a>
                                                @endif
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
