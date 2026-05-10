<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantProduct extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'merchant_id',
        'product_id',
        'stock',
        'warehouse_id'
    ];

    // Relasi dengan Merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
