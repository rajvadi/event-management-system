<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'event_datetime',
        'price',
        'capacity',
        'status',
        'image',
    ];

    protected $casts = [
        'event_datetime' => 'datetime',
    ];
}
