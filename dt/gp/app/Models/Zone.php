<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Zone extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Zone::pluck('name','id')->prepend('','');
        }
public function menages(){
	return $this->hasMany(\App\Models\Zone_i);
}

}
