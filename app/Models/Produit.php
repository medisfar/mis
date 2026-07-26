<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    public $guarded=['id'];

    public static function tab(){
    return Produit::pluck('description','id')->prepend('','');
}

public function activites() {
      return $this->belongsToMany('\App\Models\Activite');
    }
public function resultat() {
     return $this->belongsTo('\App\Models\Resultat');
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
