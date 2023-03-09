<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Level;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class PengaturanController extends Controller
{
    public function create()
    {
        $levels = Level::all();
        return view('admin.pengaturan.create', compact('levels'));
    }

    public function store(Request $request)
  {
    $validated = $request->validate([
      'level'      => 'required|unique:levels,level|string|max:20'
    ]);
  
    Auth::User()->levels()->create([
      'level'      => $request->level
      
    ]);

    return redirect('/pengaturan');
  }
  
  public function destroy($id)
  {
    Level::find($id)->delete();
    return redirect('/pengaturan');
  }

  public function createk()
    {
        $kategoris = Kategori::all();
        return view('admin.pengaturan.kategori.create', compact('kategoris'));
    }

    public function storek(Request $request)
  {
    $validated = $request->validate([
      'kategori'      => 'required|unique:kategoris,kategori|string|max:50'
    ]);
  
    Auth::User()->kategoris()->create([
      'kategori'   => $request->kategori
      
    ]);

    return redirect('/pengaturan');
  }

  public function destroyk($id)
  {
    Kategori::find($id)->delete();
    return redirect('/pengaturan');
  }

}
