<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masterdesa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function masterkecamatans()
    {
        return $this->belongsTo(Masterkecamatan::class, 'masterkecamatans_id')->orderBy('id', 'asc');
    }

    public function tanah()
    {
    return $this->hasMany(Tanah::class, 'masterdesas_id');
    }
}
