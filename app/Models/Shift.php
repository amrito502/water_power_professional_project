<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'shift_name',
        'start_time',
        'end_time',
        'break_duration',
        'recurrence',
        'applicable_days',
        'status',
    ];
}
