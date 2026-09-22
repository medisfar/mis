<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Activite extends BaseModel
{
	public $guarded=['id'];

	public static function tab(){
	return Activite::pluck('activite','id')->prepend('','');
}
public static function statuts(){
    return ['non demarrée','en cours','Terminée'];
}
public function cmnBudget(){
        $s=0;
        foreach(\App\Models\Tache::whereRaw('activite_id=? and site_id=0',[$this->id])->get() as $t)
          $s+=$t->budget;
          return $s;
    }

public static function  repos(){
         // MySQL uses UPDATE ... JOIN syntax, not UPDATE ... FROM
        \DB::statement('
            UPDATE activites
            JOIN (
                SELECT 
                    id,
                    ROW_NUMBER() OVER (PARTITION BY composante_id ORDER BY position, id) AS new_position
                FROM activites
            ) AS ranked ON activites.id = ranked.id
            SET activites.position = ranked.new_position
        ');
    
    }
 public function cmnEngage(){
        $s=0;
         foreach(\App\Models\Tache::whereRaw('activite_id=? and site_id=0',[$this->id])->get() as $t)
           $s+=$t->engage;
        return $s;   
      }

    public function cmnDecaisse(){
        $s=0;
         foreach(\App\Models\Decompte::whereRaw('activite_id=? and site_id=0',[$this->id])->get() as $d)
           $s+=$d->montant;
        return $s;   
    
    }
public function getLestatutAttribute(){
  $s=Activite::statuts();
  return $s[$this->statut]??'';
}
public function sousComposante() {
	 return $this->belongsTo('\App\Models\Souscomposante');
    }
public function projet() {
	 return $this->hasOneThrough(
         Projet::class,
         Composante::class,
         'id',
         'id',
         'composante_id',
         'projet_id'
     );
    }

public function localite() {
	 return $this->belongsTo('\App\Models\Localite');
    }
    public function composante() {
	 return $this->belongsTo('\App\Models\Composante');
    }

    public function sites() {
	 return $this->belongsToMany('\App\Models\Site')->withPivot('budget');
    }
 public function produits() {
     return $this->belongsToMany(Produit::class, 'activite_produit')
         ->withPivot([
             'id', 'ssprefecture_id', 'localite_id',
             'indicateur_realise', 'unite', 'cout', 'commentaire',
         ])
         ->withTimestamps();
    }
public function taches() {
	 return $this->hasMany('\App\Models\Tache','activite_id');
    }
public function decomptes(){
	return $this->hasMany('\App\Models\Decompte')->orderBy('site_id');
}

    public function getDecaisseAttribute(){
        $s=0;
        foreach($this->decomptes as $d)
           $s+=$d->montant;
        return $s;   
    
    }
     public function getEngageAttribute(){
        $s=0;
        foreach($this->taches as $d)
           $s+=$d->engage;
        return $s;   
    
    }
    public function getElengageAttribute(){
        $s='';
        foreach($this->sites as $d)
           $s.='+'.$d->engage;
        return $s;   
    
    }
  
    
     public function getCompletedAttribute(){
        if ($this->taches->isEmpty()) {
            return 0;
        }

        return (int) max(0, min(100, round($this->taches->avg('completed'))));
    }
}
