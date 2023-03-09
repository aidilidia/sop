@extends('layout-admin.flat')
@section('title', 'Input SOP')
@section('isi')

<x-breadcrumb judul="Input SOP" item="Input" href=""/>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex">
                        <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Input SOP</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <!-- Column -->
        <a href="/sopeksis" class="col-sm-4 bg">
            <div class="card bulu">
                <div class="card-body">
                    <h4 class="card-title">Eksis</h4>
                    <div class="text-end">
                        <h2 class="font-light mb-0">{{$eksis}}
                            <span class="text-muted">kali diajukan</span>
                        </h2>
                    </div>
                    <span class="text-success">{{$eksisDisetujui}} SOP disetujui (
                        @if($eksis > 0)
                            {{round($eksisDisetujui/$eksis*100, 2)}}% 
                        @else
                            0%
                        @endif
                        ) </span>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: 
                            @if($eksis >0)
                                {{round($eksisDisetujui/$eksis*100, 2)}}%
                            @else
                                0%
                            @endif
                            ; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </a>
        
        <a href="/sopparu" class="col-sm-4 bg">
            <div class="card bulu">
                <div class="card-body">
                    <h4 class="card-title">Baru</h4>
                    <div class="text-end">
                        <h2 class="font-light mb-0">{{$baru}}
                            <span class="text-muted">kali diajukan</span>
                        </h2>
                    </div>
                    <span class="text-info">{{$baruDisetujui}} SOP disetujui (
                        @if($baru > 0)
                            {{round($baruDisetujui/$baru*100, 2)}}% 
                        @else
                            0%
                        @endif
                        ) </span>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar"
                            style="width: 
                            @if($baru > 0)
                                {{round($baruDisetujui/$baru*100, 2)}}% 
                            @else
                                0%
                            @endif
                            ; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </a>

        <a href="sopbuah" class="col-sm-4 bg">
            <div class="card bulu">
                <div class="card-body">
                    <h4 class="card-title">Revisi</h4>
                    <div class="text-end">
                        <h2 class="font-light mb-0">{{$revisi}}
                            <span class="text-muted">kali diajukan</span>
                        </h2>
                    </div>
                    <span class="text-warning">{{$revisiDisetujui}} SOP disetujui (
                        @if($revisi > 0)
                            {{round($revisiDisetujui/$revisi*100, 2)}}% 
                        @else
                            0%
                        @endif
                        ) </span>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar"
                            style="width: 
                            @if($revisi > 0)
                                {{round($revisiDisetujui/$revisi*100, 2)}}% 
                            @else
                                0%
                            @endif
                            ; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </a>
    </div>
            <!-- </div>

        <div class="container-fluid"> -->
            <!-- <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex">
                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">MM - PM - FM - IK</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            
            <!-- <div class="row">
                <a href="" class="col-sm-4 bg">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Dalam masa tunggu ...</h4>
                            
                        </div>
                    </div>
                </a> -->
                

                
            <!-- </div> -->
    

</div>
@endsection
