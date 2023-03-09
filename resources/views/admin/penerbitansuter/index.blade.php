@extends('layout-admin.flat')
@section('title', 'SOP Sudah Terbit')
@section('isi')

<x-breadcrumb judul="SOP Yang Sudah Diterbitkan" item="Penerbitan" href="/penerbitan" />
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Daftar SOP yang sudah diterbitkan
                                        <br>&#8811; telah dapat dikonsumsi publik</h4>
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
                                                <th>Judul (usulan awal)</th>
                                                <!-- <th>Upload PDF awal</th> -->
                                                <th>Penomoran SOP</th>
                                                <th>Upload PDF yang telah disahkan</th>
                                                <th title='Eksis Baru Revisi'>EBR</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($val_1 as $input)
                                            <!-- {{$input->created_at}} -->
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <form action="/penerbitansuter-{{$input->slug}}">
                                                            <button class="btn btn-success text-dark">{{$input->nama}}</button>
                                                        </form>
                                                    </td>
                                                    <!-- <td>{{date('d F Y H:i:s', strtotime($input->tglterbit))}}</td> -->
                                                    <td>{{date('d F Y H:i:s', strtotime($input->tglnomor))}}</td>
                                                    <td>{{date('d F Y H:i:s', strtotime($input->tglpdf))}}</td>
                                                    <td>
                                                        
                                                        @if($input->jsop == 'Usulan SOP Baru')
                                                        <button class="btn btn-primary text-white">B</button>
                                                        @elseif($input->jsop == 'Usulan SOP Eksis')
                                                        <button class="btn btn-success text-dark">E</button>
                                                        @elseif($input->jsop == 'Usulan Revisi SOP')
                                                        <button class="btn btn-warning text-dark">R</button>
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
