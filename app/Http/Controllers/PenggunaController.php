<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Level;
use App\Models\Pelaksana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
  
  public function create()
    {
      $levels = Level::all();
      $pelaksanas = Pelaksana::orderBy('pelaksana', 'asc')->get();
      return view('admin.pengguna.create', compact('levels', 'pelaksanas'));
    }

    public function store(Request $request)
  {
    $validated = $request->validate([
      'name'       => 'required|string|max:255',
      'nip'        => 'required|string|digits:3|unique:users',
      'jabatan'    => 'required|string|max:255',
      'jab_atasan' => 'required|string|max:255',
      'level'      => 'required|string|max:255',
      'email'      => 'required|string|email|max:255|unique:users',
    ]);
  
    User::create([
      'name'        => $request->name,
      'nip'         => $request->nip,
      'jabatan'     => $request->jabatan,
      'jab_atasan'  => $request->jab_atasan,
      'level'       => $request->level,
      'email'       => $request->email,
      'password'    => Hash::make('soppassword'),
      'reg_by'      => Auth::user()->name,
      'aktifasi'    => 0,
    ]);

    return redirect('/daftarpengguna');
  }

  public function edit($id)
  {
    $user = User::find($id);
    $levels = Level::all();
    $users = User::all();
    return view('admin.pengguna.edit', compact('user', 'levels', 'users'));
  }

  public function update(Request $request, $id)
  {
    User::find($id)->update([
      'name'        => $request->name,
      'nip'         => $request->nip,
      'jabatan'     => $request->jabatan,
      'jab_atasan'  => $request->jab_atasan,
      'level'       => $request->level,
      'email'       => $request->email,
      'aktifasi'    => $request->aktifasi
    ]);

    return redirect('/daftarpengguna');
  }
}
