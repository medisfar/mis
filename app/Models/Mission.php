<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends BaseModel
{
    public $guarded = ['id'];

    public static function tab()
    {
        return Mission::pluck('libelle', 'id')->prepend('', '');
    }

    public function resultats()
    {
        return $this->hasMany(Resultat::class)->orderBy('position');
    }

  public function allresultats()
    {
        $res = [];
        //dd($this->secteurs);
        foreach ($this->secteurs as $secteur) {
            foreach ($secteur->resultats as $resultat) {
                $res[] = $resultat;
            }
        }
       dd($res);
        return collect($res);
    }
    public function getBudgetAttribute()
    {
        $s = 0;
        return $s;
    }

    public function getDecaisseAttribute()
    {
        $s = 0;
        return $s;
    }

    public function getEngageAttribute()
    {
        $s = 0;
        return $s;
    }
}
