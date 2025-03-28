<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareHolder extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'addressline',
        'city',
        'phone',
        'email',
        'sharePercent',
        'opening_balance',
        'status',
        'created_by',
    ];

    // Relationship with User (Creator)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
