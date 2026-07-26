<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    public $guarded=['id'];

    public static function tab(){
        return Mission::pluck('libelle','id')->prepend('','');
        }
}
