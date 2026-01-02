<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'name',
        'type',
        'price_per_hour',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
