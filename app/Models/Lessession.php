<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lessession extends Model
{
     public $guarded=['id'];
     
protected $casts = [
    'typesession_id' => 'integer',
    'site_id' => 'integer', 
    'groupement_id' => 'integer',
];

    public static function tab(){
        return Psession::pluck('date_session','id')->prepend('','');
        }
     public function site() {
	 return $this->belongsTo('\App\Models\Site');
    }
     public function groupement() {
     return $this->belongsTo('\App\Models\Groupement');
    }
    public function donnees() {
     return $this->hasMany('\App\Models\MetaDonnee');
    }
     public function typesession() {
     return $this->belongsTo('\App\Models\Typesession');
    }
}
