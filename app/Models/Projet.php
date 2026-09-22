<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Projet extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Projet::pluck('libelle','id')->prepend('','');
        }
public function bailleur_projets(){
	return $this->hasMany('\App\Models\BailleurProjet');
}
public function produits(){
	return $this->hasMany('\App\Models\Produit');
}
public function resultats(){
	return $this->hasMany('\App\Models\Resultat');
}

public function composantes(){
	return $this->hasMany('\App\Models\Composante');
}
public function sites(){
	return $this->hasMany('\App\Models\Site');
}
public function menages(){
	return $this->belongsToMany('\App\Models\Menage', 'menage_projet')->withTimestamps();
}
public static function statuts(){
	return [''=>'','Non commencé','En cours','Suspendu','Terminé'];
}
public function getLestatutAttribute(){
	$opts=Projet::statuts();
	return $opts[$this->l_statut];
}
public function bailleurs(){
	return $this->belongsToMany('\App\Models\Bailleur')->withPivot(['budget','date_f']);
}
public function getDecaisseAttribute(){
        $s=0;
        foreach($this->composantes as $d)
           $s+=$d->decaisse;
        return $s;   
    }

}
