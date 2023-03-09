@extends('layout-admin.flat')
@section('title', 'Overview Aplikasi SOP')
@section('isi')

<x-breadcrumb judul="Overview" item="Dashboard" href="/home" />


            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-warning">Diverifikasi
                                    <i class="fas fa-tasks"></i>
                                </h4>
                                <div class="text-end">
                                    <h2 class="font-light mb-0">{{$verifikasi}}
                                      <span class="text-muted">dari {{$usulan}} usulan</span>
                                    </h2>
                                </div>
                                <span class="text-warning">
                                    @if($usulan > 0)
                                        {{round($verifikasi/$usulan*100, 2)}}%
                                    @else
                                        0%
                                    @endif    
                                </span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width:
                                        @if($usulan > 0)
                                            {{round($verifikasi/$usulan*100, 2)}}%
                                        @else
                                            0%
                                        @endif
                                        ; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="card" title="dari yang telah diverifikasi">
                            <div class="card-body">
                                <h4 class="card-title text-success">Disetujui
                                    <i class="fas fa-check"></i>
                                </h4>
                                <div class="text-end">
                                    <h2 class="font-light mb-0">{{$disetujui}}
                                      <span class="text-muted">dari {{$verifikasi}} diverifikasi</span>
                                    </h2>
                                </div>
                                <span class="text-success">
                                    @if($usulan > 0)
                                        {{round($disetujui/$verifikasi*100, 2)}}%
                                    @else
                                        0%
                                    @endif
                                    
                                </span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width:
                                        @if($verifikasi > 0)
                                            {{round($disetujui/$verifikasi*100, 2)}}%
                                        @else
                                            0%
                                        @endif
                                        ; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div class="card" title="dari yang telah diverifikasi">
                            <div class="card-body">
                                <h4 class="card-title text-danger">Ditolak
                                    <i class="fas fa-times"></i>
                                </h4>
                                <div class="text-end">
                                    <h2 class="font-light mb-0">{{$ditolak}}
                                      <span class="text-muted">dari {{$verifikasi}} diverifikasi</span>
                                    </h2>
                                </div>
                                <span class="text-danger">
                                    @if($usulan > 0)
                                        {{round($ditolak/$verifikasi*100, 2)}}%
                                    @else
                                        0%
                                    @endif    
                                </span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" maxlength="4"
                                        style="width: 
                                        @if($usulan > 0)
                                            {{round($ditolak/$verifikasi*100, 2)}}%
                                        @else
                                            0%
                                        @endif    
                                        ; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-sm-3"><a style="display: block;">
                        <div class="card" title="dari yang disetujui">
                            <div class="card-body">
                                <h4 class="card-title text-primary"> 
                                    Diterbitkan
                                    <i class="fas fa-rocket"></i>
                                </h4>
                                <div class="text-end">
                                    <h2 class="font-light mb-0">{{$terbit}}
                                      <span class="text-muted">dari {{$disetujui}} disetujui</span>
                                    </h2>
                                            
                                </div>
                                <span class="text-primary">
                                    @if($usulan > 0)
                                        {{round($terbit/$disetujui*100, 2)}}%
                                    @else
                                        0%
                                    @endif
                                </span>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: 
                                        @if($usulan > 0)
                                            {{round($terbit/$disetujui*100, 2)}}%
                                        @else
                                            0%
                                        @endif
                                        ; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div> 
                        </div></a>
                    </div>
                   
                    
                </div>
                <!-- Input SOP -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Input SOP</h4>
                                    <!-- <div class="col-md-2 ms-auto">
                                        <select class="form-select shadow-none col-md-2 ml-auto">
                                            <option selected>January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                        </select>
                                    </div> -->
                                </div>
                                <div class="table-responsive mt-5">
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0" colspan="2">User</th>
                                                <th class="border-top-0">Level</th>
                                                <th class="border-top-0">Exp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($exps as $exp)
                                            <tr>
                                                @foreach($users as $user)
                                                @if($exp->user_id == $user->id)
                                                <td style="width:50px;"><span class="round" style="background-color:hsl({{19*$user->id}}, 70%, 46%);">{{strtoupper(substr($user->name, -1))}}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <h6>
                                                        {{$user->name}}
                                                    </h6>
                                                    <small class="text-muted">
                                                        {{$user->jabatan}}
                                                    </small>                                                    
                                                </td>
                                                <td class="align-middle">
                                                    {{$user->level}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="align-middle">
                                                    {{$exp->exp}} pengusulan
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
            </div>
@endsection
