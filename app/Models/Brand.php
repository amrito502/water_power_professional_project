<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'image', 'status', 'rank'];

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
}
