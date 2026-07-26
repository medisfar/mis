<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $table="psessions";
     public $guarded=['id'];

    public static function tab(){
        return Session::pluck('nom','id')->prepend('','');
        }
        public function fields() {
	 return $this->hasMany('\App\Models\Field');
    }
}
