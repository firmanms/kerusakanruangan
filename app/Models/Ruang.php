<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ruang extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bangunans()
    {
        return $this->belongsTo(Bangunan::class, 'bangunans_id')->orderBy('id', 'asc');
    }

    public function masterbangunan()
    {
        return $this->hasMany(Masterbangunan::class, 'masterruangs_id');
    }

    public function masterruangs()
    {
        return $this->belongsTo(Masterruang::class, 'masterruangs_id')->orderBy('id', 'asc');
    }

    public function masterjenisprasaranas()
    {
        return $this->belongsTo(Masterjenisprasarana::class, 'masterjenisprasaranas_id')->orderBy('id', 'asc');
    }

    public function formulirs()
    {
        return $this->belongsTo(Formulir::class, 'ruangs_id');
    }

    public function usulanrehabs()
    {
        return $this->belongsTo(Usulanrehab::class, 'ruangs_id');
    }







}
