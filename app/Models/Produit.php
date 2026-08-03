<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    public $guarded=['id'];

    public static function tab(){
    return Produit::pluck('description','id')->prepend('','');
}

public function activites() {
      return $this->belongsToMany(Activite::class, 'activite_produit')
          ->withPivot([
              'id', 'ssprefecture_id', 'localite_id',
              'indicateur_realise', 'unite', 'cout', 'commentaire',
          ])
          ->withTimestamps();
    }
public function resultat() {
     return $this->belongsTo(Resultat::class);
    }

public function contributions() {
     return $this->hasMany(ActiviteProduit::class);
    }
    
public function projet() {
     return $this->belongsTo('\App\Models\Projet');
    }
    public function getBdgeAttribute(){
     $s=0;
     foreach($this->activites as $a)
     {
       $s+=$a->budget;
     }
     return  $s;
    }
}
