@extends('layout-admin.flat')
@section('title', 'Upload PDF belum Validasi')
@section('isi')

<x-breadcrumb judul="PDF SOP Telah Diupload Tapi SOP Belum Divalidasi" item="Penerbitan" href="/penerbitan" />
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Daftar SOP yang telah diupload PDF Finalnya tapi belum divalidasi sama sekali
                                        <br>&rarr; menunggu untuk divalidasi </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($beval->count() > 0)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive mt-12">
                                    <table class="table stylish-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Judul SOP</th>
                                                <th>Tanggal Upload PDF</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($beval as $input)
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
                                                        <form action="/valsopbaru-{{$input->slug}}">
                                                            <button class="btn btn-warning text-dark">Buka Halaman Validasi</button>
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
