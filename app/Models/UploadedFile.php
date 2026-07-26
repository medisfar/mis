<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadedFile extends Model
{
    public $table="uploadedfiles";
    protected $fillable = [
        'original_name',
        'stored_path',
        'modified_path',
        'status',
        'uuid',
        'modified_column',
        'modified_value',
    ];
}
