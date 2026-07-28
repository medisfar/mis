<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Tache extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Tache::pluck('name','id')->prepend('','');
        }
public function activite(){
	return $this->belongsTo('\App\Models\Activite');
}
public function Site(){
	return $this->belongsTo('\App\Models\Site');
}
public function projet(){
	return $this->belongsTo('\App\Models\Projet');
}
}
