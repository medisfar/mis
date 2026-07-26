<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decompte extends Model
{
    public $guarded=['id'];

    public static function tab(){
        return Decompte::pluck('id','id')->prepend('','');
        }
        public function activite(){
	return $this->belongsTo('\App\Models\Activite');
}
public function site(){
	return $this->belongsTo('\App\Models\Site');
}
}
