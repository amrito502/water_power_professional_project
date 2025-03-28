<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'suppId',
        'name',
        'address',
        'city',
        'email',
        'phone',
        'crType',
        'creditDay',
        'consignmentDay',
        'ob',
        'status',
        'createdBy',
        'rank',
    ];

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
}
