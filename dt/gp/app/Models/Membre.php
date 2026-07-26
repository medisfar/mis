<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Membre extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Membre::pluck('name','id')->prepend('','');
        }

}
