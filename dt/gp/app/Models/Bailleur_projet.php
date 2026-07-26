<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Bailleur_projet extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Bailleur_projet::pluck('name','id')->prepend('','');
        }

}
