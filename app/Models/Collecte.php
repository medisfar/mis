<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collecte extends Model
{
    public $guarded=['id'];
    
    public function Projet() {
	 return $this->belongsTo('\App\Models\Projet');
    }
    public function Site() {
	 return $this->belongsTo('\App\Models\Site');
    }
}
