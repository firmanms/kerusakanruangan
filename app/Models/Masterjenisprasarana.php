<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Masterjenisprasarana extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function masterruangs()
    {
        return $this->belongsTo(Masterruang::class, 'masterruangs_id');
    }

    public function ruangs()
    {
    return $this->hasMany(Ruang::class, 'masterjenisprasaranas_id');
    }
}
