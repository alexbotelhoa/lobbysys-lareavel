<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    protected $fillable = [
        'visitor_id',
        'room_id',
    ];

    protected $guarded = [
        'id',
        'checkIn',
        'created_at',
        'update_at',
    ];

    protected $table = 'arrivals';
}
