@extends('layout-admin.flat')
@section('title', 'Daftar SOP')
@section('isi')

<x-breadcrumb judul="Daftar SOP" item="Daftar" href="/daftar" />
            <div class="container-fluid">
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
                                                        @if($input->jenisop == 'Usulan SOP Eksis' && $input->pdf == NULL)
                                                            <form action="/penerbitanbeter-{{$input->slug}}">
                                                                {{$input->nama}} <button class="btn btn-danger text-white">Beri nomor/ upload PDF</button>
                                                            </form>
                                                        @else
                                                <form action="/sopparu-{{$input->slug}}">
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
                                                    
                                                </form>
                                          </tr>
                                          @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{ $inputs->links() }}
                    </div>
                </div>
            </div>
@endsection
