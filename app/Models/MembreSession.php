<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembreSession extends Model
{
    protected $table = 'membre_session';

    public $guarded = ['id'];

    protected $casts = [
        'date_session' => 'date',
        'donnees' => 'array',
    ];

    public function membre()
    {
        return $this->belongsTo(Membre::class);
    }
}
