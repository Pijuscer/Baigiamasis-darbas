<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camp_rezervation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_profile_id',
        'camp_id'
    ];
}
