<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Input;
use App\Models\Nomor;
use App\Models\Terbit;
use App\Models\Kategori;
use App\Models\Sopfinal;
use App\Models\Validasi;
use Illuminate\Http\Request;

class SopController extends Controller
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
      
        $sops = Validasi::where('validasi', 1)
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->distinct('input_id')
                // ->select('sopfinals.pdf', 'inputs.slug', 'inputs.nama', 'sopfinals.created_at as tglpdf',
                // 'inputs.id', 'nomors.nomor', 'nomors.created_at as tglnomor', 'inputs.jenisop as jsop')
                ->select('inputs.slug', 'inputs.nama', 'inputs.revisi',
                'inputs.id', 'nomors.nomor', 'nomors.created_at as tglnomor')
                ->orderBy('sopfinals.created_at', 'desc')
                ->limit(3)
                ->get();

        $sopos = Validasi::where('validasi', 1)
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->distinct('input_id')
                ->select('inputs.slug', 'inputs.nama', 'inputs.revisi',
                'inputs.id','nomors.nomor', 'nomors.created_at as tglnomor')
                ->orderBy('sopfinals.created_at', 'desc')
                ->offset(3)
                ->limit(3)
                ->get();
        
        $forkada = Input::all();
        
        $kategoris = Validasi::where('validasi', 1)
                    ->join('inputs', 'validasis.input_id', 'inputs.id')
                    ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                    ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                    ->join('kategoris', 'kategoris.kategori', 'inputs.kategori')
                    ->where('validasis.user_id', $user_na)
                    ->select('kategoris.id', 'kategoris.kategori')
                    ->distinct('kategoris.kategori')
                    ->orderBy('kategoris.id')
                    // ->groupby('kategoris.id')
                    ->get();
                    
        $jmlkat = Validasi::where('validasi', 1)
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->join('kategoris', 'kategoris.kategori', 'inputs.kategori')
                ->where('validasis.user_id', $user_na)
                ->select('kategoris.id')
                ->get();

        $lastNama     = Validasi::where('nama', '!=', NULL)->where('validasi', 1)->get();
        $cekNoRevKada = Sopfinal::all();
                
      return view('sop.sop', compact('sops', 'sopos', 'forkada', 'kategoris', 'jmlkat', 'lastNama', 'cekNoRevKada'));
    }

    public function semua()
    {
        $user_na   = User::where('level', 'Approval')->get('id')->first();
        $user_na   = $user_na->id;
      
        $sops = Validasi::where('validasi', 1)
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->select('sopfinals.pdf', 'inputs.slug', 'inputs.nama', 'sopfinals.created_at as tglpdf',
                'inputs.id', 'nomors.nomor', 'nomors.created_at as tglnomor', 'inputs.jenisop as jsop')
                ->orderBy('sopfinals.created_at', 'desc')
                ->simplePaginate(9);

        $allsops = Validasi::where('validasi', 1)
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->get();

        $lastNama     = Validasi::where('nama', '!=', NULL)->where('validasi', 1)->get();
        $forkada       = Input::all();

                if(isset($_GET['page']))
                {
                    $hal = $_GET['page'];
                } else
                {
                    $hal = 1;
                }
                
                if($hal > 0)
                {
                    if($sops->count())
                    {
                        $mulai = ($hal * 9) - 8;
                        $sampai = $mulai - 1 + $sops->count();
                        $pang = 'Menampilkan '. $mulai;
                        $gil  =  $sampai . ' dari ' . $allsops->count() . ' SOP';
                    }
                    else
                    {
                        abort(404);
                    }
                }
                 else
                {
                    abort(404);
                }
                
        $cekNoRevKada = Sopfinal::all();
      return view('sop.semua', compact('sops', 'hal', 'mulai', 'sampai', 'pang', 'gil', 'lastNama', 'forkada', 'cekNoRevKada'));
    }

    public function kategori($slug)
    {
        $user_na   = User::where('level', 'Approval')->get('id')->first();
        $user_na   = $user_na->id;
      
        $sops = Validasi::where('validasi', 1)
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->where('inputs.kategori', $slug)
                ->select('sopfinals.pdf', 'inputs.slug', 'inputs.nama', 'sopfinals.created_at as tglpdf',
                'inputs.id', 'nomors.nomor', 'nomors.created_at as tglnomor', 'inputs.jenisop as jsop')
                ->orderBy('sopfinals.created_at', 'desc')
                ->simplePaginate(9);

        $allsops = Validasi::where('validasi', 1)
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->where('inputs.kategori', $slug)
                ->get();

        $kategori = $allsops->first();
        
                if(isset($_GET['page']))
                {
                    $hal = $_GET['page'];
                } else
                {
                    $hal = 1;
                }
                
                if($hal > 0)
                {
                    if($sops->count())
                    {
                        $mulai = ($hal * 9) - 8;
                        $sampai = $mulai - 1 + $sops->count();
                        $pang = 'Menampilkan '. $mulai;
                        $gil  =  $sampai . ' dari ' . $allsops->count() . ' SOP';
                    }
                    else
                    {
                        abort(404);
                    }
                }
                 else
                {
                    abort(404);
                }
        $lastNama     = Validasi::where('nama', '!=', NULL)->where('validasi', 1)->get();
        $forkada      = Input::all();
        $cekNoRevKada = Sopfinal::all();
        
      return view('sop.kategori', compact('sops', 'hal', 'allsops', 'mulai', 'sampai', 'pang', 'gil', 'kategori',
       'lastNama', 'forkada', 'cekNoRevKada'));
    }

    public function cari(Request $request)
    {
        $cari = $request->search;
        $user_na   = User::where('level', 'Approval')->get('id')->first();
        $user_na   = $user_na->id;
      
        $sops = Validasi::where('validasi', 1)
                ->join('inputs', 'validasis.input_id', 'inputs.id')
                ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                ->where('validasis.user_id', $user_na)
                ->where('inputs.nama', 'like','%'.$cari.'%')
                ->orWhere('validasis.nama', 'like','%'.$cari.'%')
                ->orWhere('nomors.nomor', 'like','%'.$cari.'%')
                ->distinct('inputs.id')
                ->select('sopfinals.pdf', 'inputs.slug', 'inputs.nama', 'sopfinals.created_at as tglpdf',
                'inputs.id', 'nomors.nomor', 'nomors.created_at as tglnomor', 'inputs.jenisop as jsop')
                ->orderBy('sopfinals.created_at', 'desc')
                ->get();
                
        $lastNama     = Validasi::where('nama', '!=', NULL)->where('validasi', 1)->get();
        $forkada      = Input::all();

            $pang = 'Menampilkan 1';
            $gil  =  $sops->count() . ' dari ' . $sops->count() . ' SOP';
                   
        $cekNoRevKada = Sopfinal::all();

      return view('sop.cari', compact('sops', 
         'pang', 'gil',
        'lastNama', 'forkada', 'cekNoRevKada', 'cari'));
                
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
        $input        = Input::where('slug', $slug)->first();
        $inputall     = Input::all();

        $validasis     = Validasi::where('input_id', $input->id)->where('nama', '!=', NULL)->get()->max();
        $vkategori     = Validasi::where('input_id', $input->id)->where('kategori', '!=', NULL)->get()->max();
        $vketerkaitans = Validasi::where('input_id', $input->id)->where('keterkaitans', '!=', NULL)->get()->max();
        $vpelaksana    = Validasi::where('input_id', $input->id)->where('pelaksana', '!=', NULL)->get()->max();
        $vkualifikasi  = Validasi::where('input_id', $input->id)->where('kualifikasi', '!=', NULL)->get()->max();
        $vwaktu        = Validasi::where('input_id', $input->id)->where('waktu', '!=', NULL)->get()->max();
        $vfile         = Validasi::where('input_id', $input->id)->where('file', '!=', NULL)->get()->max();
        $terbits       = Terbit::where('input_id', $input->id)->select('input_id','filepdf')->first();
        $nomor         = Nomor::where('input_id', $input->id)->first();
        $sopfinal      = Sopfinal::where('input_id', $input->id)->first();
        
        $diubah       = Input::where('revisi', $input->id)->get()->max();
            
        if($input->revisi)
        {
            $rowRevisi    = Input::where('id', $input->revisi)->first();
            $vrowRevisi   = Validasi::where('input_id', $rowRevisi->id)->where('nama', '!=', NULL)->get()->max();
            $noRevisi     = Nomor::where('input_id', $rowRevisi->id)->first();
        } else
        {
            $rowRevisi   = '';
            $vrowRevisi  = '';
            $noRevisi    = '';
        }
        
        if($diubah)
        {
            if(Validasi::where('input_id', $diubah->id)->where('nama', '!=', NULL)->where('validasi', 1)->get()->max())
            {
                $vrowUbahv = Validasi::where('input_id', $diubah->id)->where('nama', '!=', NULL)->get()->max();
                $vrowUbah  = $vrowUbahv->nama;
                $noUbah   = Nomor::where('input_id', $diubah->id)->first();
            } else
            {
                $vrowUbah = $diubah->nama;
                $noUbah   = Nomor::where('input_id', $diubah->id)->first();
            }
        } else
        {
                $vrowUbah = '';
                $noUbah   = '';
        }
        return view('sop.detail-sop', compact('input', 'inputall', 'rowRevisi', 'vrowRevisi', 'noRevisi', 
                    'vrowUbah', 'noUbah',
                    'validasis', 'vkategori', 'vketerkaitans', 'vpelaksana', 'vkualifikasi', 'vwaktu', 'vfile', 'terbits',
                    'diubah', 'nomor', 'sopfinal'));
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
