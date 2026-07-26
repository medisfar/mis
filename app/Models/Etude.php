<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Etude extends Model
{
	public $guarded=['id'];
public $timestamps=false;
	public static function tab(){
	    return Etude::pluck('nom','id')->prepend('','');
        }
     
public function projet() {
	 return $this->belongsTo('\App\Models\Projet');
    }
   
public static function statuts(){
    return ['non demarrée','en cours','terminée'];
}
public function getLestatutAttribute(){
  $s=Etude::statuts();
  return $s[$this->statut]??'';
}
}
