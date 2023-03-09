<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Input;
use App\Models\Nomor;
use App\Models\Terbit;
use App\Models\Kategori;
use App\Models\Validasi;
use App\Models\Pelaksana;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SopeksisController extends Controller
{
    public function create()
    {
      $user_na   = User::where('level', 'Approval')->get('id')->first();
      $user_na   = $user_na->id;
      
      // $inputs = Validasi::where('validasi', 1) // val 1 masuk
      //           ->join('inputs', 'validasis.input_id', 'inputs.id')
      //           ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
      //           ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
      //           ->where('validasis.user_id', $user_na)
      //           ->distinct('input_id')
      //           ->select('sopfinals.pdf', 'inputs.slug', 'inputs.nama', 'sopfinals.created_at as tglpdf',
      //           'inputs.id', 'nomors.nomor', 'nomors.created_at as tglnomor', 'inputs.jenisop as jsop')
      //           ->orderBy('tglnomor', 'asc')
      //           ->get();
      $inputs = Validasi::where('validasi', 1) // val 1 masuk
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->distinct('input_id')
                ->select('inputs.nama as nama', 'validasis.nama as validasi')
                ->get();
        
      $kategoris = Kategori::all();
        $users = User::all();
        $pelaksanas = Pelaksana::all();
        return view('admin.input.sopeksis.create', compact('kategoris', 'inputs', 'users', 'pelaksanas'));
    }

    public function store(Request $request)
  {
    $validated = $request->validate([
      'nama'        => 'required|unique:inputs,nama|string|max:255',
      'tanggal'     => 'required|before:today',
      'kategori'    => 'required|string|max:255',
      'pelaksana'   => 'required',
      'kualifikasi' => 'required|string|max:255',
      'waktu'       => 'required|max:4',
    ]);

    $slug = Str::slug($request->nama, '-');
    $jenisop = 'Usulan SOP Eksis';
    
    Auth::user()->inputs()->create([
      'nama'        => $request->nama,
      'slug'        => Str::slug($request->nama, '-'),
      'pembuatan'     => $request->tanggal,
      'kategori'    => $request->kategori,
      'pelaksana'   => $request->pelaksana,
      'kualifikasi' => $request->kualifikasi,
      'waktu'       => $request->waktu,
      'keterkaitans' => $request->keterkaitans,
      'jenisop'      => $jenisop,
    ]);
    
    return redirect('/sopeksis'.'-'.$slug);
  }

  public function createno($slug)
    {
        $kategoris     = Kategori::all();
        $users         = User::all();
        $pelaksanas    = Pelaksana::all();
        $inputs        = Input::where('slug', $slug)->first();
        $all           = Input::all();
        $validasis     = Validasi::where('input_id', $inputs->id)->where('nama', '!=', NULL)->get()->max();
        $vkategori     = Validasi::where('input_id', $inputs->id)->where('kategori', '!=', NULL)->get()->max();
        $vketerkaitans = Validasi::where('input_id', $inputs->id)->where('keterkaitans', '!=', NULL)->get()->max();
        $vpelaksana    = Validasi::where('input_id', $inputs->id)->where('pelaksana', '!=', NULL)->get()->max();
        $vkualifikasi  = Validasi::where('input_id', $inputs->id)->where('kualifikasi', '!=', NULL)->get()->max();
        $vwaktu        = Validasi::where('input_id', $inputs->id)->where('waktu', '!=', NULL)->get()->max();
        $vfile         = Validasi::where('input_id', $inputs->id)->where('file', '!=', NULL)->get()->max();
        $terbits       = Terbit::where('input_id', $inputs->id)
                        ->select('input_id','filepdf')
                        ->first();
        $nomor         = Nomor::where('input_id', $inputs->id)->first();
        
        return view('admin.input.sopeksis.createnof', compact('kategoris', 'users', 'pelaksanas', 'inputs', 'all',
        'validasis', 'vkategori', 'vketerkaitans', 'vpelaksana', 'vkualifikasi', 'vwaktu', 'vfile', 'terbits', 'nomor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeno(Request $request, $id)
    {
      
        $validated = $request->validate([
            'nomor'        => 'required|unique:nomors,nomor|min:6|max:12'
          ]);
          
            Input::find($id)->nomor()->create([
            'nomor' => $request->nomor,
            'user_id' => Auth::user()->id
          ]);

          $input = Input::where('id', $id)->first();
          $slug  = $input->slug;
          return redirect('/sopeksis-'.$slug);
    }

    public function storef(Request $request, $id)
    {
        $validated = $request->validate([
            'pdf'        => 'required|min:10|mimes:pdf|max:2358'
          ]);
          
          if(isset($request->pdf))
          {
            $imgName = Input::find($id)->id.'-' . time() . '.' . $request->pdf->extension();
          } else {
              $imgName = null;
          }
            Input::find($id)->sopfinal()->create([
            'pdf' => $imgName,
            'user_id' => Auth::user()->id
          ]);
          $request->pdf->move(public_path('sopublish'), $imgName);
          return redirect('/издательский');
    }

    public function издательский()
    {
      
        $user_na   = User::where('level', 'Approval')->get('id')->first();
        $user_na   = $user_na->id;
        
          $val_1 = Validasi::where('validasi', 1) // val 1 masuk
                  ->join('terbits', 'validasis.input_id', '=', 'terbits.input_id')
                  ->join('inputs', 'validasis.input_id', 'inputs.id')
                  ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                  ->leftjoin('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                  ->where('validasis.user_id', $user_na)
                  ->Where('sopfinals.pdf', NULL)
                  ->distinct('input_id')
                  ->select('sopfinals.pdf', 'inputs.slug', 'inputs.nama', 'terbits.created_at', 'inputs.id', 'nomors.nomor')
                  ->orderBy('validasis.created_at', 'desc')
                  ->get();

          $valEksis = Validasi::where('validasi', 1) 
                  ->leftjoin('inputs', 'inputs.id', 'validasis.input_id')
                  ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                  ->join('users', 'inputs.user_id', 'users.id')
                  ->where('validasis.user_id', $user_na)
                  ->where('inputs.jenisop','Usulan SOP Eksis')
                  ->where('users.id', Auth::user()->id)
                  ->select('inputs.nama', 'inputs.created_at', 'nomors.nomor', 'inputs.slug')
                  ->get();

        $nosop  = Nomor::all();
        
        return view('admin.input.sopeksis.издательский', compact('user_na', 'val_1', 'nosop', 'valEksis'));
      

        
    }
 
}
