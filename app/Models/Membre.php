<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Membre extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Membre::pluck('nom','id')->prepend('','');
        }
public static function parente(){
	return [''=>'','conjoint','Enfants','Parent','proche'];
}
public function menage(){
	return $this->belongsTo('\App\Models\Menage');
}


public function groupement(){
	return $this->belongsToMany('\App\Models\Groupement');
}

public function getLaparenteAttribute(){
	$opts=Membre::parente();
	return $opts[$this->lien_parente];
}
}
