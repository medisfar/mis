<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Document extends Model
{
	public $guarded=['id'];
	public $timestamps=false;

	public static function tab(){
	    return Bailleur::pluck('titre','id')->prepend('','');
        }
public function projet(){
	return $this->belongsTo('\App\Models\Projet');
}

}
