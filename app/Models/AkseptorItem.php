<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AkseptorItem extends Model
{
    use HasFactory;

    protected $table = 'ekseptor_items';
    protected $guarded = [];

    public function ekseptor(): BelongsTo
    {
        return $this->belongsTo(Ekseptor::class, 'id_ekseptor');
    }
}
