<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Echeance extends Model
{
    protected $guarded = ['id'];

    public function credit(): BelongsTo
    {
        return $this->belongsTo(Credit::class);
    }
    public function paiement(): HasOne
    {
        return $this->hasOne(Paiement::class);
    }

}
