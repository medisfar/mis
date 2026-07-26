<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Menage extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Menage::pluck('chef','id')->prepend('','');
        }

public function toit() {
     return $this->belongsTo('\App\Models\Toit');
    }

    public function membres() {
     return $this->hasMany('\App\Models\Membre');
    }
    public function localite() {
     return $this->belongsTo('\App\Models\Localite');
    }
   
}
