<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Localite extends Model
{
	public $guarded=['id'];

	public static function tab(){
	    return Localite::pluck('nom_localite','id')->prepend('','');
        }
public function zones(){
	return $this->hasMany('\App\Models\Zone');
}
public function menages(){
	return $this->hasMany('\App\Models\Menage');
}
public function ssprefecture(){
	return $this->belongsTo('\App\Models\Ssprefecture');
}
public static function types(){
	return [''=>'','Quartier','Localite','Peripherie'];
}
public function getLetypeAttribute(){
	$opts=Localite::types();
	return $opts[$this->l_type];
}
}
