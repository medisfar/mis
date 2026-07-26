<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donnee extends Model
{
     public $guarded=['id'];
     
    public function psession() {
	 return $this->belongsTo('\App\Models\Psession','session_id','id');
    }

    public function membre() {
	 return $this->belongsTo('\App\Models\Membre','membre_id');
    }
 public function site() {
      return $this->belongsTo('\App\Models\Site');
    }
     public function Groupement() {
      return $this->belongsTo('\App\Models\Groupement');
    }

}
