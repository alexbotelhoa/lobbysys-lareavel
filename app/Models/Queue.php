<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = [
        'visitor_id',
        'room_id',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'update_at',
    ];

    protected $table = 'queues';
}
