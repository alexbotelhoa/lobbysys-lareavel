<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'nrRoom',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'update_at'
    ];

    protected $table = 'rooms';

    public function concierge()
    {
        return $this->hasOne('App\Models\Concierge', 'room_id', 'id');
    }
}
