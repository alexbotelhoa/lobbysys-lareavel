<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concierge extends Model
{
    protected $fillable = [
        'visitor_id',
        'room_id',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'update_at'
    ];

    protected $table = 'concierges';

    public function visitor()
    {
        return $this->belongsTo('App\Model\Visitor');
    }

    public function room()
    {
        return $this->belongsTo('App\Model\Room');
    }
}
