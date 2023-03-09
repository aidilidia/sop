<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Input;
use App\Models\Terbit;
use App\Models\Kategori;
use App\Models\Sopfinal;
use App\Models\Validasi;
use App\Models\Pelaksana;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Skenariopemeriksaan;
use Illuminate\Support\Facades\Auth;

class SopbaruController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();
        $user_na   = User::where('level', 'Approval')->get('id')->first();
        $user_na   = $user_na->id;
        
        $inputs = Validasi::where('validasi', 1) // val 1 masuk
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->distinct('input_id')
                ->select('inputs.nama as nama', 'validasis.nama as validasi')
                ->get();

        $users = User::all();
        $pelaksanas = Pelaksana::all();
        return view('admin.input.sopbaru.create', compact('kategoris', 'inputs', 'users', 'pelaksanas'));
    }
    
    public function store(Request $request)
  {
    $validated = $request->validate([
      'nama'        => 'required|unique:inputs,nama|string|max:255',
      'kategori'    => 'required|string|max:255',
      'pelaksana'   => 'required',
      'kualifikasi' => 'required|string|max:255',
      'waktu'       => 'required|max:4',
      'file'        => 'required|mimetypes:application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:3108'
    ]);

    $imgName = $request->nama . time() . '.' . $request->file->extension();
    $request->file->move(public_path('sopbaru'), $imgName);
    $jenisop = 'Usulan SOP Baru';

    Auth::user()->inputs()->create([
      'nama'        => $request->nama,
      'slug'        => Str::slug($request->nama, '-'),
      'revisi'      => $request->revisi,
      'kategori'    => $request->kategori,
      'pelaksana'   => $request->pelaksana,
      'kualifikasi' => $request->kualifikasi,
      'waktu'       => $request->waktu,
      
      'file'        => $imgName,
      'keterkaitans' => $request->keterkaitans,
      'jenisop'     => $jenisop,
    ]);

    return redirect('/daftar');
  }

  public function show($slug)
    {
      $input = Input::where('slug', $slug)->first();

      $kategori  = $input->kategori;
      $kategori  = Skenariopemeriksaan::where('kategori', $kategori)->first();
      $validasis = Validasi::where('input_id', $input->id)->get();
      $proses    = Validasi::where('input_id', $input->id)->count();
      $sopfinal  = Sopfinal::where('input_id', $input->id)->get('pdf')->first();
      
      return view('admin.daftar.show', compact('input', 'kategori', 'validasis', 'proses', 'sopfinal'));
    }

    
}
