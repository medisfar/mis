<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Secteur extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Secteur::pluck('name','id')->prepend('','');
        }

}
