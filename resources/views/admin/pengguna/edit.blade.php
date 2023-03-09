@extends('layout-admin.flat')
@section('title', 'Edit Pengguna')
@section('isi')

<x-breadcrumb judul="Edit Pengguna" item="Pengguna" href=""/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material mx-2" method="post" action="/pengguna/{{$user->id}}">
                            @csrf
                            @method('PUT')

                            <x-input field="name" label="Nama tanpa gelar" type="text" value="{{$user->name}}"/>
                            <x-input field="nip" label="NIP" type="text" value="{{$user->nip}}"/>
                            <x-input field="jabatan" label="Jabatan" type="text" value="{{$user->jabatan}}"/>
                            <x-input field="jab_atasan" label="Jabatan Atasan" type="text" value="{{$user->jab_atasan}}"/>

                            <div class="form-group row">
                                <label for="level" class="col-md-4 col-form-label text-md-right">Level</label>
                                <div class="col-md-6">
                                    <select id="level" class="form-select shadow-none border-0 ps-0 form-control-line @error('level') is-invalid @enderror" name="level" autocomplete="level" autofocus required>
                                        <option>
                                        @isset($user->level)
                                        {{ old('level') ? old('level') : $user->level }}
                                        @else
                                        {{ old('level') }}
                                        @endisset
                                        </option>
                                        
                                            @foreach($levels as $level)
                                            <option>{{ $level->level }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                                
                            <x-input field="email" label="Email" type="email" value="{{$user->email}}"/>
                            <x-input field="aktifasi" label="Aktifasi" type="aktifasi" value="{{$user->aktifasi}}"/>

                            <div class="form-group">
                                <div class="col-sm-12 d-flex">
                                <input type="submit" name="kirim" value="Kirim" class="btn btn-success mx-auto mx-md-0 text-white">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
