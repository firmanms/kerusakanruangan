<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masterruang extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function masterjenisprasarana()
    {
        return $this->hasMany(Masterjenisprasarana::class, 'masterruangs_id');
    }

    public function ruang()
    {
    return $this->hasMany(Ruang::class, 'masterruangs_id');
    }
}
