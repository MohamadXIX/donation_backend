<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'type',
        'goal_amount',
        'raised_amount',
        'ngo_id',
        'status'
    ];
}
