<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Ivaleur extends Model
{
	public $guarded=['id'];

    protected $casts = [
        'valeur_cible' => 'integer',
        'valeur' => 'integer',
    ];

    public function indicateur()
    {
        return $this->belongsTo(Indicateur::class);
    }

}
