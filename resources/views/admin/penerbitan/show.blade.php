@extends('layout-admin.flat')
@section('title', 'SOP Menunggu Upload')
@section('isi')

<x-breadcrumb judul="SOP Menunggu Upload" item="Penerbitan" href="/penerbitan" />
            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Daftar SOP Menunggu Upload PDF</h4>
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
                                                <th>Tanggal Persetujuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            @foreach ($val_1 as $input)
                                                <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                        @if(isset($user_na))
                                                                <form action="/sopparu-{{$input->input->slug}}">
                                                                    <button class="btn btn-warning text-dark">{{$input->input->nama}}</button>
                                                                </form>
                                                                
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{date('d F Y H:i', strtotime($input->updated_at))}}
                                                        </td>
                                                        <td>
                                                            <!-- {{$input->input->id}} -->
                                                            <!-- jika belum ada pdf -->
                                                                <form action="/penerbitan-{{$input->input->slug}}">
                                                                    <button class="btn btn-danger text-white">Upload file pdf</button>
                                                                </form>
                                                            
                                                                
                                                                <!-- jika belum terbit -->
                                                                
                                                                
                                                                    <!-- <input type="checkbox" name="terbit" class="btn btn-warning text-dark" checked>
                                                                    <input type="submit" class="btn btn-warning text-dark" name="terbitkan" value="Terbitkan"> -->
                                                                
                                                                <!-- jika sudah terbit -->
                                                                <!-- <button class="btn btn-success text-white">Sudah terbit</button> -->
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

                <!-- kak -->

            </div>
@endsection
