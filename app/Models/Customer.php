<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer_code', 'user_id', 'shop_name', 'full_name', 'gender',
        'address', 'postal_code', 'thana', 'city', 'phone', 'email',
        'v_card', 'date_of_birth', 'opening_balance', 'status', 'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
