<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Credit extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Projet::pluck('montant','id')->prepend('','');
        }
public function bailleur_projets(){
	return $this->hasMany('\App\Models\BailleurProjet');
}
public function membres(){
	return $this->hasMany('\App\Models\Membre');
}
public function echeances(){
	return $this->hasMany('\App\Models\Echeance');
}
public function membre(){
	return $this->belongsTo('\App\Models\Membre');
}


}
