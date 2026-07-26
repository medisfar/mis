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

public function activites() {
	 return $this->hasMany('\App\Models\Activite');
    }
public function souscomposantes() {
	 return $this->hasMany('\App\Models\Souscomposante');
    }
    public function getDecaisseAttribute(){
        $s=0;
        foreach($this->activites as $d)
           $s+=$d->decaisse;
        return $s;   
    }
}
