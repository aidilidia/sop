<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Input;
use App\Models\Nomor;
use App\Models\Kategori;
use App\Models\Sopfinal;
use App\Models\Validasi;
use App\Models\Pelaksana;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SopbuahController extends Controller
{
    public function index()
    {
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
        return view('admin.input.sopbuah.index', compact('inputs'));
    }

    public function create()
    {
        $namapilih = $_GET['nama'];
        $inpus = Input::all('nama');
        $kategoris = Kategori::all();
        $users = User::all();
        $pelaksanas = Pelaksana::all();
            
        $inputs = Input::where('nama', $namapilih)->get()->max();
        if($inputs == NULL)
        {
          $idval  = Validasi::where('nama', $namapilih)->select('input_id')->first();
          $inputs = Input::where('id', $idval->input_id)->first();
        }
          $validasis     = Validasi::where('input_id', $inputs->id)->where('nama', '!=', NULL)->get()->max();
          $vkategori     = Validasi::where('input_id', $inputs->id)->where('kategori', '!=', NULL)->get()->max();
          $vketerkaitans = Validasi::where('input_id', $inputs->id)
                          ->where('keterkaitans', '!=', NULL)
                          ->get()
                          ->max();
          $vpelaksana    = Validasi::where('input_id', $inputs->id)->where('pelaksana', '!=', NULL)->get()->max();
          $vkualifikasi  = Validasi::where('input_id', $inputs->id)->where('kualifikasi', '!=', NULL)->get()->max();
          $vwaktu        = Validasi::where('input_id', $inputs->id)->where('waktu', '!=', NULL)->get()->max();
          $vfile         = Validasi::where('input_id', $inputs->id)->where('file', '!=', NULL)->get()->max();
          $pdf           = Sopfinal::where('input_id', $inputs->id)->get('pdf')->first();

          $user_na   = User::where('level', 'Approval')->get('id')->first();
          $user_na   = $user_na->id;
          $seleketerkaitan = Validasi::where('validasi', 1) // val 1 masuk
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->where('inputs.nama', '!=', $inputs->nama)
                ->distinct('input_id')
                ->select('inputs.nama as nama', 'validasis.nama as validasi')
                ->get();
            
          $nomor         = Nomor::where('input_id', $inputs->id)->first();
        return view('admin.input.sopbuah.create', compact('inputs', 'kategoris', 'inpus', 'users', 'pelaksanas',
        'validasis', 'vkategori', 'vketerkaitans', 'vpelaksana', 'vkualifikasi', 'vwaktu', 'vfile', 'pdf', 'seleketerkaitan', 'nomor'));
        
    }

    public function store(Request $request)
  {
    $validated = $request->validate([
      'nama'        => 'required|string|max:255',
      'kategori'    => 'required|string|max:255',
      'pelaksana'   => 'required',
      'kualifikasi' => 'required|string|max:255',
      'waktu'       => 'required|max:4',
      'file'        => 'required|mimetypes:application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:3108'
    ]);
    
    $imgName = $request->revisi ."-". time() . '.' . $request->file->extension();
    $request->file->move(public_path('sopbaru'), $imgName);
    $jenisop = 'Usulan Revisi SOP';
    $penambahan = Input::where('nama', $request->nama)->count();
    $penambahan2 = Validasi::where('nama', $request->nama)->count();
    if($penambahan + $penambahan2 == 0)
    {
      $penambahan = '';
    } else
    {
      $penambahan = $penambahan + $penambahan2;
    }

    Auth::user()->inputs()->create([
      'nama'        => $request->nama,
      'slug'        => Str::slug($request->nama, '-').$penambahan,
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


}
