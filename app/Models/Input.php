<?php

namespace App\Models;

use App\Models\User;
use App\Models\Nomor;
use App\Models\Terbit;
use App\Models\Sopfinal;
use App\Models\Validasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Input extends Model
{
    use HasFactory;

   protected $guarded = ['id'];

   protected $casts = [
    'keterkaitans' => 'array',
    'pelaksana' => 'array',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validasis()
    {
        return $this->hasMany(Validasi::class);
    }

    public function terbit()
    {
        return $this->hasMany(Terbit::class);
    }

    public function nomor()
    {
        return $this->hasMany(Nomor::class);
    }

    public function sopfinal()
    {
        return $this->hasMany(Sopfinal::class);
    }
}
