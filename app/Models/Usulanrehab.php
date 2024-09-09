<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Usulanrehab extends Model
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

    public function ruangs()
    {
        return $this->belongsTo(Ruang::class, 'ruangs_id')->orderBy('id', 'asc');
    }

}
