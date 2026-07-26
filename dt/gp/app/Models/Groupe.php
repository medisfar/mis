<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Groupe extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Groupe::pluck('name','id')->prepend('','');
        }

}
