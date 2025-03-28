<?php

namespace App\Models;

use App\Models\Sku;
use App\Models\SalesInvoice;
use Illuminate\Database\Eloquent\Model;

class SalesInvoiceItem extends Model
{
    protected $fillable = [
        'sales_invoice_id', 'sku_id', 'quantity',
        'sell_price', 'discount', 'tax', 'net_amount'
    ];

    // Sales Invoice Relationship
    public function invoice()
    {
        return $this->belongsTo(SalesInvoice::class);
    }

    // SKU/Product Relationship
    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}
