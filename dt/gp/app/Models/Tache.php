<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Tache extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Tache::pluck('name','id')->prepend('','');
        }

}
