@extends('layout-admin.flat')
@section('title', 'Daftar Pengguna')
@section('isi')

<x-breadcrumb judul="Daftar Pengguna" item="Pengguna" href=""/>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex">
                        <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Daftar Pengguna</h4>
                        <div class="text-center p-20 upgrade-btn">
                            <a href="/pengguna"
                                class="btn btn-info text-white mt-4">
                                Tambah
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive mt-5">
                        <table class="table stylish-table no-wrap">
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td style="width:50px;"><span class="round" style="background-color:hsl({{19*$user->id}}, 70%, 46%);">{{strtoupper(substr($user->name, -1))}}</span></td>
                                    <td class="align-middle">
                                        <h6>{{$user['name']}}</h6>
                                        <div class="text-muted">{{$user['email']}}</div>
                                        <small class="text-muted">{{$user['nip']}}</small> |
                                        <small class="text-muted">{{$user['jabatan']}}</small>
                                    </td>
                                    <td class="align-middle">
                                        <a href="/pengguna-{{$user->id}}-edit" class="btn btn-warning text-black">edit</a>
                                    </td>
                                    <td class="align-middle">{{$user['level']}}</td>
                                    <td class="align-middle">
                                        <small class="text-muted">registrar:</small>
                                        <div class="text-muted">{{$user['reg_by']}}</div>
                                    </td>
                                    <td class="align-middle">
                                        <small class="text-muted">terdaftar pada:</small>
                                        <div class="text-muted">{{date('d F Y H:i:s', strtotime($user['created_at']))}}</div>
                                    </td>
                                    <td class="align-middle">
                                        @if($user['aktifasi'] === 1)
                                        <div class="btn btn-success text-white">aktif</div>
                                        @else
                                        <div class="btn btn-danger text-white">non aktif</div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
