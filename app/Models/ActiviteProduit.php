<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiviteProduit extends Model
{
    protected $table = 'activite_produit';

    protected $guarded = ['id'];

    protected $casts = [
        'indicateur_realise' => 'decimal:2',
        'cout' => 'decimal:2',
    ];

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function ssprefecture()
    {
        return $this->belongsTo(Ssprefecture::class);
    }

    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }
}
