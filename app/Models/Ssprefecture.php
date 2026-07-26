<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Ssprefecture extends Model
{
	public $guarded=['id'];

	public static function tab(){
	return Ssprefecture::pluck('nom_ssprefecture','id')->prepend('','');
}
public function prefecture() {
	 return $this->belongsTo('\App\Models\Prefecture');
    }
public static function types(){
	return [''=>'','Arrondiment','Sous-Prefecture','Peripherie','chef Lieu'    ];
}
public function getLetypeAttribute(){
	$opts=Ssprefecture::types();
	return $opts[$this->l_type];
}

}
