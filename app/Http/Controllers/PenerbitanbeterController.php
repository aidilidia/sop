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
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenerbitanbeterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_na   = User::where('level', 'Approval')->get('id')->first();
      $user_na   = $user_na->id;
      
        $val_1 = Validasi::where('validasi', 1) // val 1 masuk
                ->join('terbits', 'validasis.input_id', '=', 'terbits.input_id')
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->leftjoin('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->where('inputs.jenisop','Usulan SOP Baru')
                ->Where('sopfinals.pdf', NULL)
                ->distinct('input_id')
                ->select('sopfinals.pdf', 'inputs.slug', 'inputs.nama', 'terbits.created_at', 'inputs.id', 'nomors.nomor')
                ->orderBy('validasis.created_at', 'desc')
                ->get();

        $valEksis = Input::
        // Validasi::where('validasi', 1) 
                // ->join('terbits', 'validasis.input_id', '=', 'terbits.input_id')
                // ->leftjoin('inputs', 'inputs.id', 'validasis.input_id')
                leftjoin('nomors', 'inputs.id', 'nomors.input_id')
                ->leftjoin('sopfinals', 'sopfinals.input_id', 'inputs.id')
                // ->where('validasis.user_id', $user_na)
                ->where('inputs.jenisop','Usulan SOP Eksis')
                ->Where('sopfinals.pdf', NULL)
                // ->distinct('inputs.id')
                ->orderBy('inputs.id', 'desc')
                ->select('inputs.nama', 'inputs.created_at', 'nomors.nomor', 'inputs.slug')
                ->get();

        $valrev = Validasi::where('validasi', 1) // val 1 masuk
                ->join('terbits', 'validasis.input_id', 'terbits.input_id')
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->leftjoin('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->Where('sopfinals.pdf', NULL)
                ->where('inputs.jenisop', 'Usulan Revisi SOP')
                ->distinct('input_id')
                ->select('sopfinals.pdf', 'inputs.slug', 'inputs.nama', 'terbits.created_at', 'inputs.id', 'nomors.nomor')
                ->orderBy('validasis.created_at', 'desc')
                ->get();

    $nosop  = Nomor::all();
      
      return view('admin.penerbitanbeter.index', compact('user_na', 'val_1', 'nosop', 'valEksis', 'valrev'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
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
        
        return view('admin.penerbitanbeter.create', compact('kategoris', 'users', 'pelaksanas', 'inputs', 'all',
        'validasis', 'vkategori', 'vketerkaitans', 'vpelaksana', 'vkualifikasi', 'vwaktu', 'vfile', 'terbits', 'nomor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
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
          return redirect('/penerbitanbeter-'.$slug);
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
          return redirect('/penerbitan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
