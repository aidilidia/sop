<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Input;
// use App\Models\Validasi;
use Illuminate\Http\Request;
use App\Models\Skenariopemeriksaan;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class Validasi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $user = $user->jabatan;

        $slug      = Input::where('slug', validasi())->first();
        $kategori  = Input::where('slug', $slug)
                     ->select('kategori')->first();
        $skenario1 = Skenariopemeriksaan::where('kategori', $kategori)
                     ->select('level1')->first();
        $skenario2 = Skenariopemeriksaan::where('kategori', $kategori)
                     ->select('level2')->first();
        $skenario3 = Skenariopemeriksaan::where('kategori', $kategori)
                     ->select('level3')->first();
        $skenario4 = Skenariopemeriksaan::where('kategori', $kategori)
                     ->select('level4')->first();
        $skenario5 = Skenariopemeriksaan::where('kategori', $kategori)
                     ->select('level5')->first();
        $skenario6 = Skenariopemeriksaan::where('kategori', $kategori)
                     ->select('level6')->first();

        $validasi  = Validasi::where('slug', $slug)
                     ->select('validasi')->first();

        
            // if(validasi() != NULL && $user == $skenario1 || 
            //    $user == $skenario2 || 
            //    $user == $skenario3 || 
            //    $user == $skenario4 || 
            //    $user == $skenario5 || 
            //    $user == $skenario6 )
            //    {
            //     return $next($request);
            //    }
            //     return abort(404);
    
    }
}
