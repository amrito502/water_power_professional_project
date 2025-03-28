<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockRequest extends Model
{
    protected $fillable = [
        'po_no',
        'grn_no',
        'grn_date',
        'po_date',
        'total_qty',
        'total_price',
        'total_discount',
        'total_weight',
        'grand_total',
        'remarks',
        'message',
        'supplier_id',
        'sku_id',
        'disc_percent',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the SKU associated with the stock request.
     */
    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}
