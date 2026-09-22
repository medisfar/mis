<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Credit extends Model
{
    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::created(function (Credit $credit): void {
            $firstDate = Carbon::parse($credit->date_premiere_echeance);

            for ($number = 0; $number < (int) $credit->nbre_echeance; $number++) {
                $credit->echeances()->create([
                    'date_echeance' => $firstDate->copy()->addMonthsNoOverflow($number),
                    'montant_paye' => $credit->montant_echeance,
                ]);
            }
        });
    }

    public function echeances(): HasMany
    {
        return $this->hasMany(Echeance::class);
    }

    public function membre(): BelongsTo
    {
        return $this->belongsTo(Membre::class);
    }
}
