<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'status',
        'field_id'
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
