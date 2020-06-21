<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concierge extends Model
{
    protected $fillable = [
        'visitor_id',
        'room_id',
        'checkIn',
    ];

    protected $guarded = [
        'id',
        'checkOut',
        'created_at',
        'update_at',
    ];

    protected $table = 'concierges';
}
