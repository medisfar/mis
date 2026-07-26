<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaDonnee extends Model
{
     public $guarded=['id'];
     public $table='metadonnes';
     
    public function lessession() {
	 return $this->belongsTo('\App\Models\Lessession');
    }

    public function membre() {
	 return $this->belongsTo('\App\Models\Membre','membre_id');
    }

}
