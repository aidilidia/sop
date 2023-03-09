<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Input;
use App\Models\Level;
use App\Models\Kategori;
use App\Models\Sopfinal;
use App\Models\Validasi;
use App\Models\Pelaksana;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Skenariopemeriksaan;

class AdminosController extends Controller
{
    public function show()
    {
      $baru = Input::where('jenisop', 'Usulan SOP Baru')->count();
      $eksis = Input::where('jenisop', 'Usulan SOP Eksis')->count();
      $revisi = Input::where('jenisop', 'Usulan Revisi SOP')->count();

      $approval   = User::where('level', 'Approval')->get('id')->first();
      $approval = $approval->id;

      $baruDisetujui  = Validasi::where('validasi',  1)
                    ->join('inputs', 'inputs.id', 'validasis.input_id')
                    ->where('validasis.user_id', $approval)
                    ->where('inputs.jenisop', 'Usulan SOP Baru')
                    ->distinct('validasis.input_id')
                    ->count('validasis.id');
      
      $eksisDisetujui  = Validasi::where('validasi',  1)
                  ->join('inputs', 'inputs.id', 'validasis.input_id')
                  ->where('validasis.user_id', $approval)
                  ->where('inputs.jenisop', 'Usulan SOP Eksis')
                  ->distinct('validasis.input_id')
                  ->count('validasis.id');
      
      $revisiDisetujui  = Validasi::where('validasi',  1)
                  ->join('inputs', 'inputs.id', 'validasis.input_id')
                  ->where('validasis.user_id', $approval)
                  ->where('inputs.jenisop', 'Usulan Revisi SOP')
                  ->distinct('validasis.input_id')
                  ->count('validasis.id');
      
    return view('admin.input.show', compact('baru', 'eksis', 'revisi', 'baruDisetujui', 'eksisDisetujui', 'revisiDisetujui'));
    }

    public function pengaturan()
    {
      $levels = Level::all();
      $kategoris = Kategori::all();
      $pelaksanas = Pelaksana::all();
      $skenarios = Skenariopemeriksaan::all();
    return view('admin.pengaturan.show', compact('levels', 'kategoris', 'pelaksanas', 'skenarios'));
    }

    public function pengaturanuser()
    {
      $pelaksanas = Pelaksana::all();
    return view('admin.pengaturan.showpu', compact('pelaksanas'));
    }

    public function daftar()
  {
    $user    = Auth::user()->level;
    $userjab = Auth::user()->jabatan;
    
    if($user == 'Approval' || $user == 'Penerbit')
    {
    $inputs = Input::leftjoin('sopfinals', 'inputs.id', 'sopfinals.input_id')
              ->orderBy('inputs.created_at', 'desc')
              ->select('inputs.nama', 'inputs.created_at', 'inputs.jenisop', 'inputs.slug', 'inputs.id', 'sopfinals.pdf')
              ->paginate(2022);
    } else {
    $inputs = Input::leftjoin('sopfinals', 'inputs.id', 'sopfinals.input_id')
              ->join('skenariopemeriksaans', 'inputs.kategori', 'skenariopemeriksaans.kategori')
              ->where('skenariopemeriksaans.level1', $userjab)
              ->orwhere('skenariopemeriksaans.level2', $userjab)
              ->orwhere('skenariopemeriksaans.level3', $userjab)
              ->orwhere('skenariopemeriksaans.level4', $userjab)
              ->orwhere('skenariopemeriksaans.level5', $userjab)
              ->orwhere('skenariopemeriksaans.level6', $userjab)
              ->distinct('inputs.nama')
              ->orderBy('inputs.created_at', 'desc')
              ->select('inputs.nama', 'inputs.created_at', 'inputs.jenisop', 'inputs.slug', 'inputs.id', 'sopfinals.pdf')
              ->paginate(2022);
    }
      return view('admin.daftar.daftar', compact('inputs'));
  }
  
  public function pengguna()
  {
    $users = User::orderBy('created_at', 'desc')->paginate(19);
    return view('admin.pengguna.index', compact('users'));
  }

  public function khusus()
  {
    return view('k.khusus');
  }

   
}
