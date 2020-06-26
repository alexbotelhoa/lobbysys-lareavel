<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    protected $fillable = [
        'visitor_id',
        'room_id',
        'checkIn',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'update_at',
    ];

    protected $table = 'arrivals';
}
