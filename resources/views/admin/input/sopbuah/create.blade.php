@extends('layout-admin.flat')
@section('title', 'Usulan Revisi SOP')
@section('isi')

<x-breadcrumb judul="Usulan Revisi SOP" item="Input" href=""/>
                
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="body table-responsive mt-12 d-md-flex">
                        <table class="table stylish-table">
                        <span>Identitas SOP yang akan diusulkan revisi:</span><br>
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td width="10 px">:</td>
                                    <td>
                                        @if(isset($validasis))
                                        {{$validasis->nama}}
                                        @else
                                        {{$inputs->nama}}
                                        @endif
                                    </td>
                                </tr>

                                <tr style="background-color:LightGray;">
                                    <td>Nomor</td>
                                    <td>:</td>
                                    <td>
                                        {{$nomor->nomor}}
                                    </td>
                                </tr>

                                <tr style="background-color:#f2f2f2;">
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td>
                                        {{date('d F Y', strtotime($nomor->created_at))}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>:</td>
                                    <td>
                                        @if(isset($vkategari))
                                        {{$vkategori->kategori}}
                                        @else
                                        {{$inputs->kategori}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Keterkaitan</td>
                                    <td>:</td>
                                    <td>
                                        @if(isset($vketerkaitans))
                                            @foreach($vketerkaitans->keterkaitans as $keterkaitans)
                                                <span class="btn btn-primary">{{$keterkaitans}}</span>
                                            @endforeach
                                        @elseif(isset($inputs->keterkaitans))
                                            @foreach($inputs->keterkaitans as $keterkaitans)
                                                <span class="btn btn-primary">{{$keterkaitans}}</span>
                                            @endforeach
                                        @else
                                            <i>tidak ada</i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pelaksana</td>
                                    <td>:</td>
                                    <td>
                                        @if(isset($vpelaksana))
                                            @foreach($vpelaksana->pelaksana as $pelaksana)
                                            <span class="btn btn-primary">{{$pelaksana}}</span>
                                            @endforeach
                                        @else
                                            @foreach($inputs->pelaksana as $pelaksana)
                                            <span class="btn btn-primary">{{$pelaksana}}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kualifikasi</td>
                                    <td>:</td>
                                    <td>
                                        @if(isset($vkualifikasi))
                                        {{$vkualifikasi->kualifikasi}}
                                        @else
                                        {{$inputs->kualifikasi}}
                                        @endif    
                                    </td>
                                </tr>
                                <tr>
                                    <td>Waktu</td>
                                    <td>:</td>
                                    <td>
                                        @if(isset($vwaktu))
                                        {{$vwaktu->waktu}}
                                        @else
                                        {{$inputs->waktu}}
                                        @endif
                                        menit</td>
                                </tr>
                                @if($inputs->file != NULL)
                                <tr>
                                    <td>Draf</td>
                                    <td>:</td>
                                    <td>
                                        @if(isset($vfile))
                                        <a href="/sopbaru/{$vfile->file}}">
                                        @else
                                        <a href="/sopbaru/{{$inputs->file}}">
                                        @endif
                                        <i class="far fa-file-word" style="color:blue"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>PDF</td>
                                    <td>:</td>
                                    <td>
                                        <a href="/sopublish/{{$pdf->pdf}}" target='_blank'>
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

    <div class="row">
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <div class="card-body">
                    <span>Usulan Revisi SOP:</span>
                    <form class="form-horizontal form-material mx-2" method="post" action="/sopbuahInput" enctype="multipart/form-data">
                    @csrf
                    
                    
                    <input type="hidden" name="revisi" value="{{$inputs->id}}">
                    
                    <x-input field="nama" label="Judul" type="text"/>
                    
                    <div class="form-group row">
                        <label for="kategori" class="col-md-4 col-form-label text-md-right">Kategori</label>
                        <div class="col-md-6">
                            <select id="kategori" class="form-select shadow-none border-0 ps-0 form-control-line @error('kategori') is-invalid @enderror" name="kategori" autocomplete="kategori">
                                <option>{{ old('kategori') }}<option>
                                @foreach ($kategoris as $kategori)
                                <option>{{$kategori->kategori}}</option>
                                @endforeach
                            </select>
                            
                            @error('kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="keterkaitans" class="col-md-4 col-form-label text-md-right">Keterkaitan</label>
                        <div class="col-md-6">
                            <select id="keterkaitans" multiple="multiple" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('keterkaitans') is-invalid @enderror" name="keterkaitans[]" autocomplete="keterkaitans">
                                <option>{{ old('keterkaitans[]') }}<option>
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
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <label for="pelaksana" class="col-md-4 col-form-label text-md-right">Pelaksana</label>
                        <div class="col-md-6">
                            <select id="pelaksana" multiple="multiple" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error('pelaksana') is-invalid @enderror" name="pelaksana[]" autocomplete="pelaksana">
                                <option>{{ old('pelaksana[]') }}<option>
                                @foreach ($pelaksanas as $pelaksana)
                                <option>{{$pelaksana->pelaksana}}</option>
                                @endforeach
                                
                            </select>
                            @error('pelaksana')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <x-input field="kualifikasi" label="Kualifikasi Pelaksana" type="text"/>

                    <div class="form-group row">
                        <label for="waktu" class="col-md-4 col-form-label text-md-right">Waktu yang diperlukan (menit)</label>
                        <div class="col-md-6">
                            <input id="waktu" type="text" class="form-control @error('waktu') is-invalid @enderror"  name="waktu"
                            onkeyup="validAngka(this)" autocomplete="waktu" value="{{old('waktu')}}">
                            @error('waktu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <x-input field="file" label="Draf SOP" type="file"/>
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
