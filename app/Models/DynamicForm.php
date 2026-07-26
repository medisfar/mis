<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DynamicForm extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'projet_id', 'fields'];

    protected $casts = [
        'fields' => 'array',
    ];

    // Relationship with submissions
    public function submissions()
    {
        return $this->hasMany(FormSubmission::class);
    }

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor for fields count
    public function getFieldsCountAttribute()
    {
        return count($this->fields);
    }

    // Accessor for submissions count (if not using withCount)
    public function getSubmissionsCountAttribute()
    {
        return $this->submissions()->count();
    }
}