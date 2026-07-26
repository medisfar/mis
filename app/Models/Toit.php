<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toit extends Model
{
    public $guarded=['id'];

    public static function tab(){
        return Toit::pluck('adresse','id')->prepend('','');
        }
        public function region() {
     return $this->belongsTo('\App\Models\Region');
    }
   public function menages() {
     return $this->hasMany('\App\Models\Menage');
    }
     
}
