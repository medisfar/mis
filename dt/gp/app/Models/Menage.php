<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Menage extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Menage::pluck('name','id')->prepend('','');
        }
public function membres(){
	return $this->hasMany(\App\Models\Menage_i);
}

}
