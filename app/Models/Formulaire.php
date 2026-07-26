<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulaire extends Model
{
  public $guarded=['id'];

    public static function tab(){
        return Formulaire::pluck('nom','id')->prepend('','');
        }
    public function properties(){
        
        $dt=json_decode($this->fields,1);
         
        $d=[];
        foreach($dt as $e)
          $d[$e['name']]=$e['label'];
         
         return $d;
    }
}
