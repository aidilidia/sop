<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Input;
use App\Models\Nomor;
use App\Models\Terbit;
use App\Models\Kategori;
use App\Models\Sopfinal;
use App\Models\Validasi;
use App\Models\Pelaksana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Skenariopemeriksaan;
use Illuminate\Support\Facades\Auth;

class PenerbitanController extends Controller
{

  public function index()
  {
    $user_na   = User::where('level', 'Approval')->get('id')->first();
      $user_na   = $user_na->id;                 // get id appr
      
      $tuf = Terbit::all()->count('input_id'); //total yang telah upload file
      
      // total seluruh validasi
      $tsv = Validasi::where('validasi', 1) // validasi diisi 1 karna untuk valid
                ->where('user_id', $user_na)     // validasi oleh apr
                ->distinct('input_id')
                ->count();                           // total seluruh yg divalidasi 1 oleh apr

      // $jumu = $tsv - $tuf;
      $jumu = Validasi::where('validasi', 1) 
              ->leftjoin('terbits', 'validasis.input_id', 'terbits.input_id')
              ->leftjoin('inputs', 'inputs.id', 'validasis.input_id')
              ->where('validasis.user_id', $user_na)
              ->where('terbits.input_id', NULL)
              ->where('inputs.jenisop', '!=', 'Usulan SOP Eksis')
              ->distinct('terbits.input_id')
              ->select('validasis.input_id', 'validasis.updated_at')
              ->get();
      // jumlah belum terbit sop baru
      $jumbeterBaru = Terbit::leftjoin('sopfinals', 'terbits.input_id', 'sopfinals.input_id')
                  ->leftjoin('nomors', 'nomors.input_id', 'terbits.input_id')
                  ->where('sopfinals.id', NULL)
                  ->select('terbits.input_id')
                  ->distinct('terbits.input_id')
                  ->count();

      // jumlah belum terbit sop eksis
      $jumbeterEksis = Validasi::where('validasi', 1)
              ->join('terbits', 'validasis.input_id', '=', 'terbits.input_id')
              ->leftjoin('inputs', 'inputs.id', 'validasis.input_id')
              ->leftjoin('sopfinals', 'inputs.id', 'sopfinals.input_id')
              ->where('validasis.user_id', $user_na)
              ->where('inputs.jenisop','Usulan SOP Eksis')
              ->where('sopfinals.id', NULL)
              ->select('validasis.input_id', 'validasis.updated_at')
              ->count();

       // jumlah belum terbit
      $jumbeter = $jumbeterBaru + $jumbeterEksis;
      $suter = Validasi::where('validasi', 1) // val 1 masuk
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->distinct('validasis.input_id')
                ->select('inputs.id')
                ->count();

      $sopfinal = Input::join('nomors', 'inputs.id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'inputs.id')
                ->leftjoin('validasis', 'validasis.input_id', 'inputs.id')
                ->where('sopfinals.user_id', $user_na)
                ->where('validasis.validasi', NULL)
                ->distinct('validasis.input_id')
                ->select('inputs.nama')
                ->get();
                
    return view('admin.penerbitan.index', compact('jumbeter', 'jumu', 'suter', 'sopfinal'));
  }
    
  public function show()
  {
      $user_na   = User::where('level', 'Approval')->get('id')->first();
      $user_na   = $user_na->id;
      
      $terbits = Terbit::all()->get('input_id');
     
      $val_1 = Validasi::where('validasi', 1) 
              ->leftjoin('terbits', 'validasis.input_id', '=', 'terbits.input_id')
              ->leftjoin('inputs', 'inputs.id', 'validasis.input_id')
              ->where('validasis.user_id', $user_na)
              ->where('terbits.input_id', NULL)
              ->where('inputs.jenisop', '!=', 'Usulan SOP Eksis')
              ->distinct('input_id')
              ->select('validasis.input_id', 'validasis.updated_at')
              ->orderBy('validasis.updated_at', 'desc')
              ->get();

      return view('admin.penerbitan.show', compact('user_na', 'val_1', 'terbits'));
  }
        public function create($slug)
    {
      $kategoris = Kategori::all();
        $users = User::all();
        $pelaksanas = Pelaksana::all();
        $inputs = Input::where('slug', $slug)->first();
        $all = Input::all();
        $validasis = Validasi::where('input_id', $inputs->id)->where('nama', '!=', NULL)->get()->max();
        $vkategori = Validasi::where('input_id', $inputs->id)->where('kategori', '!=', NULL)->get()->max();
        $vketerkaitans = Validasi::where('input_id', $inputs->id)->where('keterkaitans', '!=', NULL)->get()->max();
        $vpelaksana = Validasi::where('input_id', $inputs->id)->where('pelaksana', '!=', NULL)->get()->max();
        $vkualifikasi = Validasi::where('input_id', $inputs->id)->where('kualifikasi', '!=', NULL)->get()->max();
        $vwaktu = Validasi::where('input_id', $inputs->id)->where('waktu', '!=', NULL)->get()->max();
        $vfile = Validasi::where('input_id', $inputs->id)->where('file', '!=', NULL)->get()->max();
                        
        return view('admin.penerbitan.create', compact('kategoris', 'users', 'pelaksanas', 'inputs', 'all',
        'validasis', 'vkategori', 'vketerkaitans', 'vpelaksana', 'vkualifikasi', 'vwaktu', 'vfile'));
    }

    public function store(Request $request, $id)
    {
      $validated = $request->validate([
        'filepdf'        => 'required|min:10|mimes:pdf|max:1123'
      ]);
      
      if(isset($request->filepdf))
      {
        $imgName = Input::find($id)->id.'-' . time() . '.' . $request->filepdf->extension();
      } else {
          $imgName = null;
      }
        Input::find($id)->terbit()->create([
        'filepdf' => $imgName,
        'user_id' => Auth::user()->id
      ]);
      $request->filepdf->move(public_path('soppdf'), $imgName);
      return redirect('/penerbitan');
    }
  
}
