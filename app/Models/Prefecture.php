<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Prefecture extends Model
{
	public $guarded=['id'];

	public static function tab(){
	return Prefecture::pluck('nom_prefecture','id')->prepend('','');
}
public function region() {
	 return $this->belongsTo('\App\Models\Region');
    }

public function ssprefectures() {
	 return $this->hasMany('\App\Models\Ssprefecture');
    }

public static function types(){
	return [''=>'','Commune','Prefecture'];
}
public function getLetypeAttribute($v){

	$opts=Prefecture::types();

	return $opts[$this->l_type]??'';
}


}
