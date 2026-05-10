<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'merchant_id',
        'product_id',
        'quantity',
        'total_price',
    ];

    // Relasi 1 : Transaction belongs to Merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // Relasi 2 : Transaction has Many TransactionProduct (untuk detail transaksi)
    public function transactionProducts()
    {
        return $this->hasMany(TransactionProduct::class);
    }
}
