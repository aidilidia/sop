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
                                        <span style="color:grey; text-align:right">
                                        &becaus; Tabel <span style="color:red"> Sop Eksis </span>hanya untuk monitoring, bukan untuk penerbitan. Final penerbitannya ada pada validasi.
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($val_1->count() > 0)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive mt-12">
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>SOP Baru (usulan awal)</th>
                                                <th>Tanggal Upload PDF</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($val_1 as $input)
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
                                                        <form action="/penerbitanbeter-{{$input->slug}}">
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
                @endif

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
                                                <th title="Detail dapat diakses setelah upload PDF">SOP Eksis (belum validasi)</th>
                                                <th>Tanggal Input</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($valEksis as $input)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <!-- <form action="/sopparu-{{$input->slug}}"> -->
                                                            <button class="btn btn-warning text-dark">{{$input->nama}}</button>
                                                        <!-- </form> -->
                                                    </td>
                                                    <td>{{date('d F Y H:i', strtotime($input->created_at))}}
                                                    </td>
                                                    <td>
                                                        <form action="/penerbitanbeter-{{$input->slug}}">
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
                @endif

                @if($valrev->count() > 0)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive mt-12">
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>SOP Revisi</th>
                                                <th>Tanggal Input</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($valrev as $input)
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
                                                        <form action="/penerbitanbeter-{{$input->slug}}">
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
                @endif

            </div>
@endsection
