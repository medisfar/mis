<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Resultat extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Resultat::pluck('description','id')->prepend('','');
        }
public function projet() {
	 return $this->belongsTo('\App\Models\Projet');
	 
    }
    
    
public static function  repos(){
         // MySQL uses UPDATE ... JOIN syntax, not UPDATE ... FROM
        \DB::statement('
            UPDATE resultats
            JOIN (
                SELECT 
                    id,
                    ROW_NUMBER() OVER (PARTITION BY mission_id ORDER BY position, id) AS new_position
                FROM resultats
            ) AS ranked ON resultats.id = ranked.id
            SET resultats.position = ranked.new_position
        ');
    
    }
public function mission() {
	 return $this->belongsTo('\App\Models\Mission');
    }
public function secteur() {
	 return $this->belongsTo('\App\Models\Secteur');
    }
    public function produits() {
     return $this->belongstoMany('\App\Models\Produit');
    }
    
    public function odds() {
     return $this->belongstoMany('\App\Models\Odd');
    }
}
