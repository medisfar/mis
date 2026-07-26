<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    	public $guarded=['id'];

	public static function tab(){
	return Field::pluck('nom','id')->prepend('','');
}
public function Psession() {
	 return $this->belongsTo('\App\Models\Psession');
    }
}
