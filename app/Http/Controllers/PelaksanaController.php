<?php

namespace App\Http\Controllers;

use App\Models\Pelaksana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelaksanaController extends Controller
{
    public function create()
    {
        $pelaksanas = Pelaksana::all();
        return view('admin.pelaksana.create', compact('pelaksanas'));
    }

    public function store(Request $request)
  {
    $validated = $request->validate([
      'pelaksana'      => 'required|unique:pelaksanas,pelaksana|string|max:50'
    ]);
  
    Auth::user()->pelaksanas()->create([
      'pelaksana'      => $request->pelaksana
    ]);
    
    if(filter_var('/pengaturan', FILTER_VALIDATE_URL))
      return redirect('/pengaturan');
    else
      return redirect('/pengaturanuser');
    
  }
  
  public function destroy($id)
  {
    Pelaksana::find($id)->delete();
    return redirect('/pengaturan');
  }
}
