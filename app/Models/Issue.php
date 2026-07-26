<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Issue extends Model
{
	public $guarded=['id'];
	public $timestamps=false;

	public static function tab(){
	    return Issue::pluck('title','id')->prepend('','');
	}

  public static function priorities(){
      return [
          'low'=>"low",
          'high'=>'high'];
  }
  public static function statuses(){
      return [
          'open'=>"open",
          'in progress'=>'in progess',
          'resolved'=>'resolved',
          'closed'=>'closed'];
  }
  
public function user(){
	return $this->belongsTo('\App\Models\User');
}
}
