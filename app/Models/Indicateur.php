<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Indicateur extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Indicateur::pluck('nom','id')->prepend('','');
        }


    
    public static function lesFrequences()
{
    return ['mensuelle', 'trimestrielle', 'annuelle'];
}

public function activite(){
	return $this->belongsTo('\App\Models\Activite');
}

public function valeurs(){
	return $this->hasMany('\App\Models\Ivaleur');
}

public function getLafrequenceAttribute()
{
   $ar=Indicateur::frequences();
    return $ar[$this->frequence];
}

public static function sources(){
    return ['Enquete','Rapports','Systeme'];
}
public static function niveaux(){
    return ['Impact',
'Effet',
'Produit',
'Activite'
];
}

public static function frequences(){
    return ['Memsuel',
'Trimestrielle',
'Semestrielle',
'Annuelle'

        ];
}

public function getLasourceAttribute()
{
   $ar=Indicateur::sources();
    return $ar[$this->source];
}
public function getLeniveauAttribute()
{
   $ar=Indicateur::niveaux();
    return $ar[$this->niveau];
}

} 
