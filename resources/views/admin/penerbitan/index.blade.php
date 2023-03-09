@extends('layout-admin.flat')
@section('title', 'Penerbitan SOP')
@section('isi')

<x-breadcrumb judul="Penerbitan SOP" item="Input" href=""/>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Status Penerbitan SOP Eksis, SOP Baru dan Revisi SOP</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <a href="/penerbitansuter" class="col-sm-4 bg">
                        <div class="card bulu">
                            <div class="card-body">
                                <h4 class="card-title">Sudah terbit</h4>
                                <div class="text-end">
                                    <h2 class="font-light mb-0">{{$suter}} SOP</h2>
                                    <span class="text-muted">telah dapat dikonsumsi publik</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                    @if($jumbeter > 0)
                    <a href="/penerbitanbeter" class="col-sm-4 bg">
                    @else
                    <a class="col-sm-4 bg">
                    @endif
                        <div class="card bulu">
                            <div class="card-body">
                                <h4 class="card-title">Belum terbit</h4>
                                <div class="text-end">
                                    @if($jumbeter > 0)
                                    <h2 class="font-light mb-0">
                                    {{$jumbeter}} Usulan SOP
                                    @elseif($jumbeter == 0)
                                    <h2 class="font-light mb-0" style=" text-align: center;">
                                    <i style="font-size: 58px;" class="fas fa-check text-success"></i>
                                    @endif
                                    </h2>
                                    <span class="text-muted">
                                        @if($jumbeter > 0)
                                        menunggu  diberi nomor dan upload PDF
                                        @endif
                                    </span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </a>

                    @if($jumu->count() > 0)
                    <a href="penerbitan-mu" class="col-sm-4 bg">
                    @else
                    <a class="col-sm-4 bg">
                    @endif
                        <div class="card bulu">
                            <div class="card-body">
                                <h4 class="card-title">Menunggu upload</h4>
                                <div class="text-end">
                                    @if($jumu->count() > 0)
                                    <h2 class="font-light mb-0">
                                    {{$jumu->count()}} Usulan SOP
                                    @elseif($jumu->count() == 0)
                                    <h2 class="font-light mb-0" style=" text-align: center;">
                                    <i style="font-size: 58px;" class="fas fa-check text-success"></i>
                                    @endif
                                    </h2>
                                    <span class="text-muted">
                                        @if($jumu->count() > 0)
                                        dari yang telah disetujui
                                        @endif
                                    </span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="row">
                    <a href="/penerbitanbeval" class="col-sm-4 bg">
                        <div class="card bulu">
                            <div class="card-body">
                                <h4 class="card-title">Upload PDF tapi belum validasi</h4>
                                <div class="text-end">
                                    <h2 class="font-light mb-0">{{$sopfinal->count()}} daftar</h2>
                                    <span class="text-muted">Usulan SOP Eksis</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
@endsection
