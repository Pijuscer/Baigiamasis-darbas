<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_name',
        'event_organizer',
        'event_address',
        'event_date',
        'event_foto',
        'event_more_info',
        'event_number_of_participants',
        'event_longitude_coordinate',
        'event_latitude_coordinate'
    ];
}
