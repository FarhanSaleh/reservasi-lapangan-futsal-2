<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasion extends Model
{
    protected $fillable = [
        'user_id',
        'schedule_id',
        'reservation_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
