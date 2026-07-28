<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicateur extends Model
{
    public $guarded = ['id'];

    protected $casts = [
        'baseline' => 'decimal:2',
        'valeur_cible' => 'decimal:2',
        'valeur_actuelle' => 'decimal:2',
        'est_actif' => 'boolean',
    ];

    public static function tab()
    {
        return Indicateur::pluck('nom', 'id')->prepend('', '');
    }

    public static function frequences(): array
    {
        return [
            '0' => 'Mensuelle',
            '1' => 'Trimestrielle',
            '2' => 'Semestrielle',
            '3' => 'Annuelle',
            '4' => 'Bimensuelle',
        ];
    }

    public static function niveaux(): array
    {
        return [
            '0' => 'Impact',
            '1' => 'Effet',
            '2' => 'Produit',
            '3' => 'Activité',
        ];
    }

    public static function sources(): array
    {
        return [
            '0' => 'Enquête',
            '1' => 'Rapport',
            '2' => 'Système',
            '3' => 'Formulaire',
            '4' => 'Ministère',
            '5' => 'DPSE',
            '6' => 'Sensibilisation',
            '7' => 'Séance foyer',
            '8' => 'Saisie manuelle',
        ];
    }

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function valeurs()
    {
        return $this->hasMany(Ivaleur::class);
    }

    public function getFrequenceLibelleAttribute(): string
    {
        return static::frequences()[(string) $this->frequence]
            ?? (string) ($this->frequence ?? '');
    }

    public function getNiveauLibelleAttribute(): string
    {
        return static::niveaux()[(string) $this->niveau]
            ?? (string) ($this->niveau ?? '');
    }

    public function getSourceLibelleAttribute(): string
    {
        return static::sources()[(string) $this->source]
            ?? (string) ($this->source ?? '');
    }

    // Compatibilité avec les anciens écrans Indicateur.
    public function getLafrequenceAttribute(): string
    {
        return $this->frequence_libelle;
    }

    public function getLeniveauAttribute(): string
    {
        return $this->niveau_libelle;
    }

    public function getLasourceAttribute(): string
    {
        return $this->source_libelle;
    }
}
