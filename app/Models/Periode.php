<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Periode extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Periode::pluck('name','id')->prepend('','');
        }


    public function indicateur() {
	 return $this->belongsTo('\App\Models\Indicateur');
    }
}