<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masterkecamatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function masterdesas()
    {
        return $this->hasMany(Masterdesa::class, 'masterkecamatans_id');
    }

    public function tanah()
    {
    return $this->hasMany(Tanah::class, 'masterkecmatans_id');
    }
}
