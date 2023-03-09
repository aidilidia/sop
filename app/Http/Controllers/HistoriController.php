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
use App\Models\Skenariopemeriksaan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user    = Auth::user()->level;
        $userjab = Auth::user()->jabatan;
        
        $inputs = Input::leftjoin('sopfinals', 'inputs.id', 'sopfinals.input_id')
                ->orderBy('inputs.created_at', 'desc')
                ->select('inputs.nama', 'inputs.created_at', 'inputs.jenisop', 'inputs.slug', 'inputs.id', 'sopfinals.pdf')
                ->get();
                
        return view('admin.histori.index', compact('inputs'));
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
        $input = Input::where('slug', $slug)->first();

        $kategori  = $input->kategori;
        $kategori  = Skenariopemeriksaan::where('kategori', $kategori)->first();
        $validasis = Validasi::where('input_id', $input->id)->get();
        $proses    = Validasi::where('input_id', $input->id)->count();
        $sopfinal  = Sopfinal::where('input_id', $input->id)->get()->first();
        $terbit    = Terbit::where('input_id', $input->id)->get()->first();
        $nomor     = Nomor::where('input_id', $input->id)->get()->first();
        
        return view('admin.histori.show', compact('input', 'kategori', 'validasis', 'proses', 'sopfinal', 'terbit', 'nomor'));
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
