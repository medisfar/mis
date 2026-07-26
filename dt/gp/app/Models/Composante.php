<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Composante extends Model
{
	public $guarded=['id'];

	public static function tab(){
	return Composante::pluck('code','id')->prepend('','');
}
public function projet() {
	 return $this->belongsTo('\App\Models\Projet');
    }


public function souscomposantes() {
	 return $this->hasMany('\App\Models\Souscomposante');
    }

}
