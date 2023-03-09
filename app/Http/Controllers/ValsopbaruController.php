<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Input;
use App\Models\Kategori;
use App\Models\Sopfinal;
use App\Models\Validasi;
use App\Models\Pelaksana;
use Illuminate\Http\Request;
use App\Models\Skenariopemeriksaan;

class ValsopbaruController extends Controller
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
    public function create($slug)
    {
        $kategoris = Kategori::all();
        $users = User::all();
        $pelaksanas = Pelaksana::all();
        $inputs = Input::where('slug', $slug)->first();
        $all = Input::all();
        $validasis = Validasi::where('input_id', $inputs->id)->where('nama', '!=', NULL)->get();
        $vkategori = Validasi::where('input_id', $inputs->id)->where('kategori', '!=', NULL)->get();
        $vketerkaitans = Validasi::where('input_id', $inputs->id)->where('keterkaitans', '!=', NULL)->get();
        $vpelaksana = Validasi::where('input_id', $inputs->id)->where('pelaksana', '!=', NULL)->get();
        $vkualifikasi = Validasi::where('input_id', $inputs->id)->where('kualifikasi', '!=', NULL)->get();
        $vwaktu = Validasi::where('input_id', $inputs->id)->where('waktu', '!=', NULL)->get();
        $vfile = Validasi::where('input_id', $inputs->id)->where('file', '!=', NULL)->get();

        $kategoriCek  = $inputs->kategori; // kategori slug
        $kategoriCek  = Skenariopemeriksaan::where('kategori', $kategoriCek)->first(); 
        $inputid = $inputs->id; 
        
        $katlevel1 = $kategoriCek->level1; 
        $katlevel2 = $kategoriCek->level2; 
        $katlevel3 = $kategoriCek->level3;
        $katlevel4 = $kategoriCek->level4;
        $katlevel5 = $kategoriCek->level5;
        $katlevel6 = $kategoriCek->level6;
        $katlevel7 = 'Approval';
        
        $jabuser   = Auth::user()->jabatan;
        $userLevel = Auth::user()->level;
        
        if($katlevel1 == $jabuser ||
        $katlevel2 == $jabuser ||
        $katlevel3 == $jabuser ||
        $katlevel4 == $jabuser ||
        $katlevel5 == $jabuser ||
        $katlevel6 == $jabuser ||
        $katlevel7 == $userLevel )
        {
            
            if(Validasi::where('input_id', $inputid)->first() != NULL) 
            {
                $validasisCek = Validasi::where('input_id', $inputid)->first();
                $jabUserVal     = $validasisCek->user->jabatan;
                $levelUserVal     = $validasisCek->user->level;
                
                if($jabUserVal != $jabuser && $levelUserVal != $katlevel7) 
                {
                    $sopfinal = Sopfinal::where('input_id', $inputs->id)->get('pdf')->first();

                    $user_na   = User::where('level', 'Approval')->get('id')->first();
                    $user_na   = $user_na->id;
                    
                    $seleketerkaitan = Validasi::where('validasi', 1) 
                            ->join('inputs', 'validasis.input_id', 'inputs.id')
                            ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                            ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                            ->where('validasis.user_id', $user_na)
                            ->distinct('input_id')
                            ->select('inputs.nama as nama', 'validasis.nama as validasi')
                            ->get();

                    if(isset($inputs->revisi))
                    {
                        $r              = Input::where('id', $inputs->revisi)->first();
                        $rvalidasis     = Validasi::where('input_id', $r->id)->where('nama', '!=', NULL)->get()->max();
                        $rkategori      = Validasi::where('input_id', $r->id)->where('kategori', '!=', NULL)->get()->max();
                        $rketerkaitans  = Validasi::where('input_id', $r->id)->where('keterkaitans', '!=', NULL)->get()->max();
                        $rpelaksana     = Validasi::where('input_id', $r->id)->where('pelaksana', '!=', NULL)->get()->max();
                        $rkualifikasi   = Validasi::where('input_id', $r->id)->where('kualifikasi', '!=', NULL)->get()->max();
                        $rwaktu         = Validasi::where('input_id', $r->id)->where('waktu', '!=', NULL)->get()->max();
                        $rfile          = Validasi::where('input_id', $r->id)->where('file', '!=', NULL)->get()->max();
                    
                        return view('admin.daftar.validasi', compact('kategoris', 'users', 'pelaksanas', 'inputs', 'all',
                                    'validasis', 'vkategori', 'vketerkaitans', 'vpelaksana', 'vkualifikasi', 'vwaktu', 'vfile', 'r',
                                    'rvalidasis', 'rkategori', 'rketerkaitans', 'rpelaksana', 'rkualifikasi', 'rwaktu', 'rfile', 'seleketerkaitan'));
                    } else {
                        return view('admin.daftar.validasi', compact('kategoris', 'users', 'pelaksanas', 'inputs', 'all',
                        'validasis', 'vkategori', 'vketerkaitans', 'vpelaksana', 'vkualifikasi', 'vwaktu', 'vfile', 'sopfinal', 'seleketerkaitan'));
                    }

                } else {
                    return abort(403);
                }
            } else
            {
                $sopfinal = Sopfinal::where('input_id', $inputs->id)->get('pdf')->first();

                $user_na   = User::where('level', 'Approval')->get('id')->first();
                $user_na   = $user_na->id;
                
                $seleketerkaitan = Validasi::where('validasi', 1) 
                        ->join('inputs', 'validasis.input_id', 'inputs.id')
                        ->leftjoin('nomors', 'validasis.input_id', 'nomors.input_id')
                        ->join('sopfinals', 'sopfinals.input_id', 'validasis.input_id')
                        ->where('validasis.user_id', $user_na)
                        ->distinct('input_id')
                        ->select('inputs.nama as nama', 'validasis.nama as validasi')
                        ->get();

                if(isset($inputs->revisi))
                {
                    $r              = Input::where('id', $inputs->revisi)->first();
                    $rvalidasis     = Validasi::where('input_id', $r->id)->where('nama', '!=', NULL)->get()->max();
                    $rkategori      = Validasi::where('input_id', $r->id)->where('kategori', '!=', NULL)->get()->max();
                    $rketerkaitans  = Validasi::where('input_id', $r->id)->where('keterkaitans', '!=', NULL)->get()->max();
                    $rpelaksana     = Validasi::where('input_id', $r->id)->where('pelaksana', '!=', NULL)->get()->max();
                    $rkualifikasi   = Validasi::where('input_id', $r->id)->where('kualifikasi', '!=', NULL)->get()->max();
                    $rwaktu         = Validasi::where('input_id', $r->id)->where('waktu', '!=', NULL)->get()->max();
                    $rfile          = Validasi::where('input_id', $r->id)->where('file', '!=', NULL)->get()->max();
                
                    return view('admin.daftar.validasi', compact('kategoris', 'users', 'pelaksanas', 'inputs', 'all',
                                'validasis', 'vkategori', 'vketerkaitans', 'vpelaksana', 'vkualifikasi', 'vwaktu', 'vfile', 'r',
                                'rvalidasis', 'rkategori', 'rketerkaitans', 'rpelaksana', 'rkualifikasi', 'rwaktu', 'rfile', 'seleketerkaitan'));
                } else {
                    return view('admin.daftar.validasi', compact('kategoris', 'users', 'pelaksanas', 'inputs', 'all',
                    'validasis', 'vkategori', 'vketerkaitans', 'vpelaksana', 'vkualifikasi', 'vwaktu', 'vfile', 'sopfinal', 'seleketerkaitan'));
                }
            }
        } else
        {
            return abort(403);
        }
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
            'file'        => 'mimetypes:application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:3108'
          ]);
      
          if(isset($request->file))
          {
            $imgName = $request->nama . time() . '.' . $request->file->extension();
            $request->file->move(public_path('sopbaru'), $imgName);
          } else {
              $imgName = null;
          }

          if($request->validasi == 1)
          {
              $request->keterangan = null;
          }
          
          Input::find($id)->validasis()->create([
            'nama'         => $request->nama,
            'kategori'     => $request->kategori,
            'keterkaitans' => $request->keterkaitans,
            'pelaksana'    => $request->pelaksana,
            'kualifikasi'  => $request->kualifikasi,
            'waktu'        => $request->waktu,            
            'file'         => $imgName,
            'validasi'     => $request->validasi,
            'keterangan'   => $request->keterangan,
            'user_id' => Auth::user()->id
          ]);

          return redirect('/daftar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
