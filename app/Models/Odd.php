<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Odd extends Model
{  public $timesamps=false;
	public $guarded=['id'];

	public static function tab(){
	    return Odd::pluck('nom','id')->prepend('','');
        }

}
