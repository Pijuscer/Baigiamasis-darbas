<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_name',
        'event_address',
        'event_date',
        'event_foto',
        'more_info',
        'longitude_coordinate',
        'latitude_coordinate'
    ];
}
