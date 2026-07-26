<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasPosition;

abstract class BaseModel extends Model
{
    use HasPosition;
}