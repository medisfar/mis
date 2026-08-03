<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Odd extends Model
{  public $timestamps=false;
	public $guarded=['id'];

	public static function tab(){
	    return Odd::pluck('nom','id')->prepend('','');
        }

	public function resultats()
	{
		return $this->belongsToMany(Resultat::class, 'odd_resultat');
	}
}
