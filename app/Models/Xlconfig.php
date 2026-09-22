<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Xlconfig extends Model
{
    protected $fillable = ['name', 'headers'];
    protected $casts = ['headers' => 'array'];
    public function lines() { return $this->hasMany(XlconfigLine::class, 'xlconfig_id'); }
}
