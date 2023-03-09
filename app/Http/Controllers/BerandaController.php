<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Input;
use App\Models\Validasi;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terdaftar  = Input::all()->count();
        $user_na    = User::where('level', 'Approval')->get('id')->first();
        $user_na    = $user_na->id;
        $terbit     = Validasi::where('validasi', 1)
                    ->join('inputs', 'validasis.input_id', 'inputs.id')
                    ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                    ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                    ->where('validasis.user_id', $user_na)
                    ->distinct('validasis.input_id')
                    ->select('inputs.id')
                    ->count();

        return view('welcome', compact('terdaftar', 'terbit'));
        
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
        //
    }
}
