@extends('layout-admin.flat')
@section('title', 'Detail Histori SOP')
@section('isi')

<x-breadcrumb judul="Detail Histori SOP" item="Histori" href="/Histori" />
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
                        <i style="background-color: yellow;">
                        <span>SOP ini diusulkan oleh {{$input->user->name}}<br>
                        pada {{date('d F Y H:i', strtotime($input->created_at))}}</span><br>
                        </i>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
        @if($proses > 0)
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex">
                            <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Validasi</h4>
                        </div>
                    
                        <div class="d-md-flex">
                            <table class="table stylish-table">
                                <tbody>
                                    @foreach($validasis as $validasi)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}.
                                                <i style="background-color: yellow;">
                                                    Pada {{date('d F Y H:i', strtotime($validasi->created_at) )}}, {{$validasi->user->jabatan}} melakukan validasi: <br>
                                                </i>
                                                @if($validasi->nama)
                                                nama: {{$validasi->nama}} <br>
                                                @endif

                                                @if($validasi->kategori)
                                                kategori: {{$validasi->kategori}} <br>
                                                @endif
                                                
                                                @if($validasi->keterkaitans)
                                                    keterkaitan: 
                                                    @foreach($validasi->keterkaitans as $keterkaitan)
                                                        {{$keterkaitan}}, 
                                                    @endforeach
                                                @endif

                                                @if($validasi->pelaksana)
                                                    keterkaitan: 
                                                    @foreach($validasi->pelaksana as $pelak)
                                                        {{$pelak}}, 
                                                    @endforeach
                                                    <br>
                                                @endif

                                                @if($validasi->kualifikasi)
                                                kualifikasi: {{$validasi->kualifikasi}} <br>
                                                @endif

                                                @if($validasi->waktu)
                                                waktu: {{$validasi->waktu}} menit <br>
                                                @endif

                                                @if($validasi->file)
                                                file: 
                                                <a href="/sopbaru/{{$validasi->file}}">
                                                    <i class="far fa-file-word" style="color:blue"></i>
                                                </a>
                                                <br>
                                                @endif

                                                @if($validasi->keterangan)
                                                keterangan: {{$validasi->keterangan}} <br>
                                                @endif

                                                @if($validasi->validasi == true)
                                                Kesimpulan: menyetujui
                                                @else
                                                Kesimpulan: menolak
                                                @endif

                                            </td>        
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($terbit)
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex">
                            <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Upload PDF OCR</h4>
                        </div>
                    
                        <div class="d-md-flex">
                            <i style="background-color: yellow;">
                                Pada {{date('d F Y H:i', strtotime($terbit->created_at) )}}, {{$terbit->user->jabatan}} mengupload 
                            </i>
                            &nbsp;  
                            <a href="/soppdf/{{$terbit->filepdf}}" target="_blank">
                                <i class="far fa-file-pdf" style="color:red"></i>
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($nomor)
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex">
                            <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Nomor PDF</h4>
                        </div>
                    
                        <div class="d-md-flex">
                            <i style="background-color: yellow;">
                                Pada {{date('d F Y H:i', strtotime($nomor->created_at) )}}, {{$nomor->user->jabatan}} memberi nomor:
                            </i>
                            &nbsp;  {{$nomor->nomor}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($sopfinal)
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex">
                            <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">PDF Final</h4>
                        </div>
                    
                        <div class="d-md-flex">
                            <i style="background-color: yellow;">
                                Pada {{date('d F Y H:i', strtotime($sopfinal->created_at) )}}, {{$sopfinal->user->jabatan}} mengupload 
                            </i>
                            &nbsp;  
                            <a href="/sopublish/{{$sopfinal->pdf}}" target="_blank">
                                <i class="far fa-file-pdf" style="color:red"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

                                            
    </div>
    
@endsection
