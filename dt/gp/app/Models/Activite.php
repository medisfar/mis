<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Activite extends Model
{
	public $guarded=['id'];

	public static function tab(){
	return Activite::pluck('activite','id')->prepend('','');
}
public function sousComposante() {
	 return $this->belongsTo('\App\Models\Souscomposante');
    }

public function composante() {
	 return $this->belongsTo('\App\Models\Composante');
    }

public function activites() {
	 return $this->hasMany('\App\Models\Activite');
    }

public function taches() {
	 return $this->hasMany('\App\Models\Tache');
    }

}
