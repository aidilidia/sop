<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Input;
use App\Models\Sopfinal;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $inputs = Input::all();
      
      $exps = DB::table('inputs')
             ->select(DB::raw('count(*) as exp, user_id'))
             ->groupBy('user_id')
             ->get();

      $users      = User::all();
      $usulan     = Input::all()->count();
      $verifikasi = Validasi::distinct('input_id')->count('id');
      $validasi   = Validasi::all();
      $approval   = User::where('level', 'Approval')->get('id')->first();
      $approval = $approval->id;
      
      $disetujui  = Validasi::where('validasi',  1)
                    ->where('user_id', $approval)
                    ->distinct('input_id')
                    ->count('id');
                    
      $ditolak    = Validasi::where('validasi',  0)
                    ->where('user_id', $approval)
                    ->distinct('input_id')
                    ->count('id');

      $user_na   = User::where('level', 'Approval')->get('id')->first();
      $user_na   = $user_na->id;
      $terbit     = Validasi::where('validasi', 1)
                    ->join('inputs', 'validasis.input_id', 'inputs.id')
                    ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                    ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                    ->where('validasis.user_id', $user_na)
                    ->distinct('validasis.input_id')
                    ->select('inputs.id')
                    ->count();
      
        return view('home', compact('inputs', 'exps', 'users', 'usulan', 'verifikasi', 'disetujui', 'ditolak', 'terbit'));
    }
    
}
