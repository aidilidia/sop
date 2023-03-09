<?php

namespace App\Models;

use App\Models\Input;
use App\Models\Level;
use App\Models\Nomor;
use App\Models\Terbit;
use App\Models\Sopfinal;
use App\Models\Validasi;
use App\Models\Skenariopemeriksaan;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nip',
        'jabatan',
        'jab_atasan',
        'level',
        'email',
        'password',
        'reg_by',
        'aktifasi',
    ];

    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function inputs()
    {
        return $this->hasMany(Input::class);
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function kategoris()
    {
        return $this->hasMany(Kategori::class);
    }

    public function pelaksanas()
    {
        return $this->hasMany(Pelaksana::class);
    }

    public function skenariopemeriksaan()
    {
        return $this->hasMany(Skenariopemeriksaan::class);
    }

    public function validasis()
    {
        return $this->hasMany(Validasi::class);
    }

    public function terbit()
    {
        return $this->hasMany(Terbit::class);
    }

    public function nomors()
    {
        return $this->hasMany(Nomor::class);
    }

    public function sopfinal()
    {
        return $this->hasMany(Sopfinal::class);
    }
}
