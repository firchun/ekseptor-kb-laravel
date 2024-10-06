<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ekseptor extends Model
{
    use HasFactory;

    protected $table = 'ekseptor';
    protected $guarded = [];


    public function puskesmas(): BelongsTo
    {
        return $this->belongsTo(Puskesmas::class, 'id_puskesmas');
    }
    public function kelurahan(): BelongsTo
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan');
    }
}
