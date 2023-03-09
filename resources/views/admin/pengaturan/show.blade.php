@extends('layout-admin.flat')
@section('title', 'Pengaturan')
@section('isi')

<x-breadcrumb judul="Pengaturan SOP" item="Pengaturan" href="/pengaturan" />
    <div class="container-fluid">
        <div class="row">
            <a href="/level" class="col-sm-4 bg">
                <div class="card ">
                    <div class="card-body bulu">
                        <h4 class="card-title">Level</h4>
                        <div class="text-end">
                            <h2 class="font-light mb-0">{{$levels->count()}}
                                <span class="text-muted">pengaturan</span>
                            </h2>
                        </div>
                        <span class="text-success">Level User</span>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </a>

            <div class="col-sm-4">
                <table class="table stylish-table no-wrap">
                    <tbody>
                        @foreach ($levels as $level)
                        <tr class="table user-table no-wrap">
                            <td>{{$level->level}}</td>
                            <td>
                                <form action="/level/{{ $level->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn"><i class="fas fa-trash-alt" style="color:red" ></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <a href="/kategori" class="col-sm-4 bg">
                <div class="card bulu">
                    <div class="card-body">
                        <h4 class="card-title">Kategori</h4>
                        <div class="text-end">
                            <h2 class="font-light mb-0">{{$kategoris->count()}}
                                <span class="text-muted">pengaturan</span>
                            </h2>
                        </div>
                        <span class="text-info">Kategori SOP</span>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar"
                                style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col-sm-5">
                <table class="table stylish-table no-wrap">
                    <tbody>
                        @foreach ($kategoris as $kategori)
                        <tr>
                            <td>{{$kategori->kategori}}</td>
                            <td>
                                <form action="/kategori/{{ $kategori->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn"><i class="fas fa-trash-alt" style="color:red" ></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <a href="/pelaksana" class="col-sm-4 bg">
                <div class="card bulu">
                    <div class="card-body">
                        <h4 class="card-title">Pelaksana/ Pejabat</h4>
                        <div class="text-end">
                            <h2 class="font-light mb-0">{{$pelaksanas->count()}}
                                <span class="text-muted">pengaturan</span>
                            </h2>
                        </div>
                        <span class="text-warning">Pelaksana SOP</span>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col-sm-5">
                <table class="table stylish-table no-wrap">
                    <tbody>
                        @foreach ($pelaksanas as $pelaksana)
                        <tr>
                            <td>{{$pelaksana->pelaksana}}</td>
                            <td>
                                <form action="/pelaksana/{{ $pelaksana->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn"><i class="fas fa-trash-alt" style="color:red" ></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <a href="/skenario" class="col-sm-4 bg">
                <div class="card bulu">
                    <div class="card-body">
                        <h4 class="card-title">Skenario Pemeriksaan</h4>
                        <div class="text-end">
                            <h2 class="font-light mb-0">{{$skenarios->count()}}
                                <span class="text-muted">skenario</span>
                            </h2>
                        </div>
                        <span class="text-primary">Skenario Pemeriksaan SOP</span>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col-sm-8 table-responsive">
                <table class="table stylish-table no-wrap">
                    <tbody>
                        @foreach ($skenarios as $skenario)
                        <tr>
                            <td>
                                {{$skenario->kategori}} <br>
                                <small>{{$skenario->level1}}&nbsp;&nbsp;->&nbsp;&nbsp;{{$skenario->level2}}
                                @isset($skenario->level3)    
                                &nbsp;&nbsp;->&nbsp;&nbsp;{{$skenario->level3}}
                                @endisset

                                @isset($skenario->level4)    
                                &nbsp;&nbsp;->&nbsp;&nbsp;{{$skenario->level4}}
                                @endisset

                                @isset($skenario->level5)    
                                &nbsp;&nbsp;->&nbsp;&nbsp;{{$skenario->level5}}
                                @endisset

                                @isset($skenario->level6)    
                                &nbsp;&nbsp;->&nbsp;&nbsp;{{$skenario->level6}}
                                @endisset
                                </small>
                            </td>
                            <td>
                                <form action="/skenario/{{ $skenario->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn"><i class="fas fa-trash-alt" style="color:red" ></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
