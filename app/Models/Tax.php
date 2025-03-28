<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = ['tax_rate', 'tax_type', 'status', 'rank'];

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
}
