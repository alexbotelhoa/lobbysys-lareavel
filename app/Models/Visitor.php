<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'name',
        'cpf',
        'birth',
        'email',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'update_at'
    ];

    protected $table = 'visitors';

    public function concierge()
    {
        return $this->hasOne('App\Models\Concierge', 'visitor_id', 'id');
    }
}
