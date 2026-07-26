<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Resultat extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Resultat::pluck('name','id')->prepend('','');
        }

}
