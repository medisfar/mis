<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Typesession extends Model
{
    public $guarded=['id'];
    public $timestamps=false;

    public static function tab(){
        return Typesession::pluck('nom','id')->prepend('','');
        }
        
     
}