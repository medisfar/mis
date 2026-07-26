<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupement extends Model
{
    public $guarded=['id'];

    public static function tab(){
        return Groupement::pluck('nom_groupe','id')->prepend('','');
        }
        public function site() {
	 return $this->belongsTo('\App\Models\Site');
    }
    
public function projet() {
	 return $this->belongsTo('\App\Models\Projet');
    }

     public function membres() {
	 return $this->belongsToMany('\App\Models\Membre');
    }
     public function formulaire(){
	 return $this->belongsToMany('\App\Models\Formulaire');
    }    
}
