@extends('layout-admin.flat')
@section('title', 'Pengaturan')
@section('isi')

<x-breadcrumb judul="Pengaturan SOP" item="Pengaturan" href="/pengaturan" />
    <div class="container-fluid">
        

        

        <div class="row">
            <a href="/pelaksana" class="col-sm-4 bg">
                <div class="card bulu">
                    <div class="card-body">
                        <h4 class="card-title">Pelaksana/ Pejabat</h4>
                        <div class="text-end">
                            <h2 class="font-light mb-0">{{$pelaksanas->count()}}
                                <span class="text-muted">pengaturan</span>
                            </h2>
                        </div>
                        <span class="text-warning">Pelaksana SOP</span>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="col-sm-5">
                <table class="table stylish-table no-wrap">
                    <tbody>
                        @foreach ($pelaksanas as $pelaksana)
                        <tr>
                            <td>{{$pelaksana->pelaksana}}</td>
                            <td>
                                @if(Auth::user()->id == $pelaksana->user->id)
                                    <form action="/pelaksana/{{ $pelaksana->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn"><i class="fas fa-trash-alt" style="color:red" ></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>
@endsection
