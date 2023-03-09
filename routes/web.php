<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SopController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminosController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\SopbaruController;
use App\Http\Controllers\SopbuahController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SopeksisController;
use App\Http\Controllers\PelaksanaController;
use App\Http\Controllers\PenerbitanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ValsopbaruController;
use App\Http\Controllers\PenerbitanbeterController;
use App\Http\Controllers\PenerbitanbevalController;
use App\Http\Controllers\PenerbitansuterController;
use App\Http\Controllers\SkenariopemeriksaanController;

Route::get('/', [BerandaController::class, 'index']);

Auth::routes();

Route::get('/sop', [SopController::class, 'index']);
Route::get('/detail-{slug}', [SopController::class, 'show']);
Route::get('/semua', [SopController::class, 'semua']);
Route::get('/kategori-{slug}', [SopController::class, 'kategori']);
Route::get('/cari', [SopController::class, 'cari']);

Route::get('/k/khusus', [AdminosController::class, 'khusus']);

Route::middleware(['aktif'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/input', [AdminosController::class, 'show']);
    Route::get('/daftar', [AdminosController::class, 'daftar']);

    Route::get('/sopparu', [SopbaruController::class, 'create']);
    Route::post('/sopparu', [SopbaruController::class, 'store']);
    Route::get('/sopparu-{slug}', [SopbaruController::class, 'show']);
    
    Route::get('/valsopbaru-{slug}', [ValsopbaruController::class, 'create']);
    Route::post('/valsopbaru-{slug}', [ValsopbaruController::class, 'store']);
    
    Route::get('/pengaturanuser', [AdminosController::class, 'pengaturanuser']);
    Route::get('/pelaksana', [PelaksanaController::class, 'create']);
    Route::post('/pelaksana', [PelaksanaController::class, 'store']);
    Route::delete('/pelaksana/{id}', [PelaksanaController::class, 'destroy']);

    Route::get('/sopeksis', [SopeksisController::class, 'create']);
    Route::post('/sopeksis', [SopeksisController::class, 'store']);
    Route::get('/sopeksis-{slug}', [SopeksisController::class, 'createno']);
    Route::post('/sopeksis-{slug}', [SopeksisController::class, 'storeno']);
    Route::post('/sopeksisf-{slug}', [SopeksisController::class, 'storef']);
    Route::get('/издательский', [SopeksisController::class, 'издательский']);
    
    Route::get('/sopbuah', [SopbuahController::class, 'index']);
    Route::get('/sopbuahInput', [SopbuahController::class, 'create']);
    Route::post('/sopbuahInput', [SopbuahController::class, 'store']);
    
    Route::middleware(['admin'])->group(function(){
        Route::get('/daftarpengguna', [AdminosController::class, 'pengguna']);
        Route::get('/pengguna', [PenggunaController::class, 'create']);
        Route::post('/pengguna', [PenggunaController::class, 'store']);
        Route::get('/pengguna-{id}-edit', [PenggunaController::class, 'edit']);
        Route::put('/pengguna/{id}', [PenggunaController::class, 'update']);

        Route::get('/pengaturan', [AdminosController::class, 'pengaturan']);
    
        Route::get('/level', [PengaturanController::class, 'create']);
        Route::post('/level', [PengaturanController::class, 'store']);
        Route::delete('/level/{id}', [PengaturanController::class, 'destroy']);

        Route::get('/kategori', [PengaturanController::class, 'createk']);
        Route::post('/kategori', [PengaturanController::class, 'storek']);
        Route::delete('/kategori/{id}', [PengaturanController::class, 'destroyk']);

        Route::get('/skenario', [SkenariopemeriksaanController::class, 'create']);
        Route::post('/skenario', [SkenariopemeriksaanController::class, 'store']);
        Route::delete('/skenario/{id}', [SkenariopemeriksaanController::class, 'destroy']);
    });

    Route::middleware(['terbit'])->group(function(){
        Route::get('/penerbitan', [PenerbitanController::class, 'index']);
        Route::get('/penerbitan-mu', [PenerbitanController::class, 'show']);
        Route::post('/penerbitan-{slug}', [PenerbitanController::class, 'store']);
        Route::get('/penerbitan-{slug}', [PenerbitanController::class, 'create']);

        Route::get('/penerbitanbeter', [PenerbitanbeterController::class, 'index']);
        Route::post('/penerbitanbeterf-{slug}', [PenerbitanbeterController::class, 'storef']);
        
        Route::get('/penerbitansuter', [PenerbitansuterController::class, 'index']);
        Route::get('/penerbitansuter-{slug}', [PenerbitansuterController::class, 'show']);

        Route::get('/penerbitanbeval', [PenerbitanbevalController::class, 'index']);
        Route::get('/penerbitanbeval-{slug}', [PenerbitanbevalController::class, 'show']);

        Route::get('/penerbitanbeter-{slug}', [PenerbitanbeterController::class, 'create']);
        Route::post('/penerbitanbeter-{slug}', [PenerbitanbeterController::class, 'store']);

        Route::get('/histori', [HistoriController::class, 'index']);
        Route::get('/histori-{slug}', [HistoriController::class, 'show']);
        
    });

    
});