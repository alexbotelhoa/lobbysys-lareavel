<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'name',
        'cpf',
        'room',
        'birth',
        'email',
    ];
}
