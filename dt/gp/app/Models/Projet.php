<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Projet extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Projet::pluck('nom_projet','id')->prepend('','');
        }
public function bailleur_projets(){
	return $this->hasMany('\App\Models\BailleurProjet');
}
public function composantes(){
	return $this->hasMany('\App\Models\Composante');
}
public static function statuts(){
	return [''=>'','Non commencé','En cours','Suspendu','Terminé'];
}
public function getLestatutAttribute(){
	$opts=Projet::statuts();
	return $opts[$this->statut];
}
}
