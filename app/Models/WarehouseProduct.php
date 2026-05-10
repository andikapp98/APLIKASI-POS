<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseProduct extends Model
{
    use SoftDeletes; // Menambahkan trait SoftDeletes

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'stock',
    ];

    // Relasi 1: Menghubungkan kembali dengan Warehouse
    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }

    // Relasi 2: Menghubungkan kembali dengan Product
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
