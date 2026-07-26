<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Psession extends Model
{
    public $table="psessions";
     public $guarded=['id'];

    public static function tab(){
        return Psession::pluck('nom','id')->prepend('','');
        }
        public function fields() {
	 return $this->hasMany('\App\Models\Field');
    }
     public function projet() {
	 return $this->belongsTo('\App\Models\Projet');
    }
}
