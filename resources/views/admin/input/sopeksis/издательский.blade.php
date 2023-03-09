@extends('layout-admin.flat')
@section('title', 'SOP Belum Terbit')
@section('isi')

<x-breadcrumb judul="SOP Yang Belum Diterbitkan" item="Penerbitan" href="/penerbitan" />
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Daftar SOP yang belum diterbitkan 
                                        <br>&rarr; menunggu untuk diberi nomor 
                                        <br>&rarr; belum upload PDF final</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($valEksis->count() > 0)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive mt-12">
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul SOP Eksis</th>
                                                <th>Tanggal Input</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($valEksis as $input)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <form action="/sopparu-{{$input->slug}}">
                                                            <button class="btn btn-warning text-dark">{{$input->nama}}</button>
                                                        </form>
                                                    </td>
                                                    <td>{{date('d F Y H:i', strtotime($input->created_at))}}
                                                    </td>
                                                    <td>
                                                        <form action="/sopeksis-{{$input->slug}}">
                                                            @if(isset($input->nomor))
                                                                <button class="btn btn-success text-dark">Upload PDF Final</button>
                                                            @else
                                                                <button class="btn btn-warning text-dark">Beri Nomor</button>
                                                            @endif
                                                        </form>
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
                @else
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive mt-12">
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul SOP Eksis</th>
                                                <th>Tanggal Input</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan=4 style="text-align: center; color:blue">
                                                    <i>Tidak ada daftar SOP yang belum diterbitkan</i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @endif

            </div>
@endsection
