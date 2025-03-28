<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkuDepartment extends Model
{
    protected $fillable = ['name', 'status', 'rank'];

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
}
