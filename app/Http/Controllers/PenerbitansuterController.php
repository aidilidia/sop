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
use App\Http\Controllers\Controller;

class PenerbitansuterController extends Controller
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
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->distinct('input_id')
                ->select('sopfinals.pdf', 'inputs.slug', 'inputs.nama', 'sopfinals.created_at as tglpdf',
                'inputs.id', 'nomors.nomor', 'nomors.created_at as tglnomor', 'inputs.jenisop as jsop')
                ->orderBy('sopfinals.created_at', 'desc')
                ->get();
        
      return view('admin.penerbitansuter.index', compact('user_na', 'val_1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
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
        $sopfinal      = Sopfinal::where('input_id', $inputs->id)->first();
        return view('admin.penerbitansuter.show', compact('kategoris', 'users', 'pelaksanas', 'inputs', 'all',
        'validasis', 'vkategori', 'vketerkaitans', 'vpelaksana', 'vkualifikasi', 'vwaktu', 'vfile', 'terbits', 'nomor', 'sopfinal'));
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
