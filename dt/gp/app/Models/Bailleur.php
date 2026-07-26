<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Bailleur extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Bailleur::pluck('name','id')->prepend('','');
        }
public function bailleur_projets(){
	return $this->hasMany(\App\Models\Bailleur_i);
}

}
