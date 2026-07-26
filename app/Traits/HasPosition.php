<?php

namespace App\Traits;

trait HasPosition
{
    public function getPositionAttribute()
    {
        $orderBy = $this->positionColumn ?? 'id';
        $direction = $this->positionDirection ?? 'desc';
        
        return static::where($orderBy, $direction === 'asc' ? '<' : '>', $this->{$orderBy})
                     ->count() + 1;
    }
}