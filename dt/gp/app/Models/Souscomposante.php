<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Souscomposante extends Model
{
	public $guarded=['id'];

	public static function tab(){
	return Souscomposante::pluck('code','id')->prepend('','');
}
public function composante() {
	 return $this->belongsTo('\App\Models\Composante');
    }

}
