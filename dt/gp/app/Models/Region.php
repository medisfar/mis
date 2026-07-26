<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Region extends Model
{
	public $guarded=['id'];

	public static function tab(){
	return Region::pluck('nom_region','id')->prepend('','');
}
}
