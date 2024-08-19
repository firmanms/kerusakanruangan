<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tanah extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function masterkecamatans()
    {
        return $this->belongsTo(Masterkecamatan::class, 'masterkecamatans_id')->orderBy('id', 'asc');
    }

    public function masterdesas()
    {
        return $this->belongsTo(Masterdesa::class, 'masterdesas_id')->orderBy('id', 'asc');
    }
}
