<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Indicateur extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Indicateur::pluck('name','id')->prepend('','');
        }

}
