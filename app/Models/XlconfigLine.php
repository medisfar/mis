<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XlconfigLine extends Model
{
    protected $fillable = ['xlconfig_id', 'line', 'table', 'field'];
    public function config() { return $this->belongsTo(Xlconfig::class, 'xlconfig_id'); }
}
