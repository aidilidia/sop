<?php

namespace App\Models;

use App\Models\User;
use App\Models\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sopfinal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function input()
    {
        return $this->belongsTo(Input::class);
    }
}
