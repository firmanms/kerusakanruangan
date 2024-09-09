<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bangunan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tanahs()
    {
        return $this->belongsTo(Tanah::class, 'tanahs_id');
    }

    public function masterbangunans()
    {
        return $this->belongsTo(Masterbangunan::class, 'masterbangunans_id');
    }

    public function masterjenisprasaranas()
    {
        return $this->belongsTo(Masterjenisprasarana::class, 'masterjenisprasaranas_id');
    }

    public function ruangs()
    {
        return $this->belongsTo(Ruang::class, 'bangunans_id');
    }

    public function formulirs()
    {
        return $this->belongsTo(Formulir::class, 'bangunans_id');
    }

    public function usulanrehabs()
    {
        return $this->belongsTo(Usulanrehab::class, 'bangunans_id');
    }


}
