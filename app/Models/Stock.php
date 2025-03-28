<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'supplier_id',
        'sku_id',
        'qty',
        'stock_date',
        'cost_price',
        'additional_cost',
        'discount_percent',
        'remarks',
        'message',
        'created_by',
        'status',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the SKU associated with the stock.
     */
    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    /**
     * Get the user who created the stock.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
