<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Album extends Model
{
	public $guarded=['id'];
	public $timestamps=false;
	public static function tab(){
	    return Album::pluck('titre','id')->prepend('','');
        }
public function projet(){
	return $this->belongsTo('\App\Models\Projet');
}
public function photos(){
    
	return $this->hasMany('\App\Models\Photo');
}
}
