<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    use HasFactory;
    protected $fillable = [
        'camp_name',
        'camp_organizer',
        'camp_address',
        'camp_arrival_date',
        'camp_leave_date',
        'camp_foto',
        'camp_more_info',
        'camp_number_of_participants',
        'camp_longitude_coordinate',
        'camp_latitude_coordinate'
    ];
}
