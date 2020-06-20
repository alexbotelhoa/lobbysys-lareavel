<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concierge extends Model
{
    protected $fillable = [
        'visitor_id',
        'room_id',
        'active',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'update_at'
    ];

    protected $table = 'concierges';

    public function visitor()
    {
        return $this->hasOne('App\Models\Visitor', 'id', 'visitor_id');
    }

    public function room()
    {
        return $this->hasOne('App\Models\Room', 'id', 'room_id');
    }
}
