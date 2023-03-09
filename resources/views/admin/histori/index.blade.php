@extends('layout-admin.flat')
@section('title', 'Histori SOP')
@section('isi')

<x-breadcrumb judul="Histori SOP" item="Histori" href="/histori" />
    <div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex">
                        <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Pilih judul untuk melihat histori lengkap usulan SOP</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-5">
                            <table class="table stylish-table no-wrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Pengusulan</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inputs as $input)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <form action="/histori-{{$input->slug}}">
                                                @if($input->jenisop == 'Usulan SOP Eksis' && $input->pdf == NULL)
                                                    <button class="btn btn-danger text-white">{{$input->nama}}</button>
                                                @else
                                                    @if($lastval = $input->validasis->max())
                                                        @if($jablastval = $lastval->user->jabatan)
                                                            @if($jablastval == 'Ketua')
                                                            <button class="btn btn-success text-dark">{{$input->nama}}</button>
                                                            @else
                                                            <button class="btn btn-warning text-dark">{{$input->nama}}</button>
                                                            @endif
                                                        @endif
                                                    @endif

                                                    @if(!isset($lastval))
                                                    <button class="btn btn-info text-white">{{$input->nama}}</button>
                                                    @endif
                                                @endif
                                            </form>
                                                
                                        </td>
                                        <td>{{date('d F Y H:i', strtotime($input->created_at))}}</td>
                                        <td>{{$input->jenisop}}</td>
                                        <td>
                                                @if($lastval = $input->validasis->max())
                                                    @if($jablastval = $lastval->user->jabatan)
                                                        @if($jablastval == 'Ketua')
                                                        <a class="text-success">Persetujuan</a>
                                                        @else
                                                        <a class="text-warning">Pemeriksaan</a>
                                                        @endif
                                                    @endif
                                                @endif

                                                @if(!isset($lastval))
                                                <a class="text-info">Pengusulan</a>
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
    </div>
@endsection
