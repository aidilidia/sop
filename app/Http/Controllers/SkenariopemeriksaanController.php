<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Skenariopemeriksaan;
use Illuminate\Support\Facades\Auth;

class SkenariopemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $jabatans = User::all();
        $skenarios = Skenariopemeriksaan::all();
        return view('admin.skenariopemeriksaan.create', compact('skenarios', 'jabatans', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori'    => 'required|unique:skenariopemeriksaans,kategori|string',
            'level1'      => 'required|string',
            'level2'      => 'required|string'
          ]);
        
          Auth::user()->skenariopemeriksaan()->create([
            'kategori'    => $request->kategori,
            'level1'      => $request->level1,
            'level2'      => $request->level2,
            'level3'      => $request->level3,
            'level4'      => $request->level4,
            'level5'      => $request->level5,
            'level6'      => $request->level6
            
          ]);
      
          return redirect('/pengaturan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        Skenariopemeriksaan::find($id)->delete();
        return redirect('/pengaturan');
    }
}
