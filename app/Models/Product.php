<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'photo',
        'price',
        'category_id',
        'is_popular',
    ];

    // Relasi 1: belongsTo Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi 2: Many-to-Many dengan Merchant (Stock kpemilikan)
    public function merchants()
    {
        return $this->belongsToMany(Merchant::class, 'merchant_products')
            ->withPivot('stock', 'warehouse_id') // mengambil kolom 'stock' dan tabel pivot
            ->withTimestamps();
    }

    // Relasi 3: Many-to-many dengan Warehouse (Stock fisik)
    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_products')
            ->withPivot('stock') // mengambil kolom 'stock' dan tabel pivot
            ->withTimestamps();
    }

    // Relasi 4: HasMany TransactionProduct (untuk detail transaksi)
    public function transactionProducts()
    {
        return $this->hasMany(TransactionProduct::class);
    }

    //Helper:  Hitung total stockdi semua Warehouse
    public function getWarehouseProductStock()
    {
        return $this->warehouses()->sum('stock');
    }

    //Accessor untuk mengubah thumbnail menjadi URL publik
    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return null;
        }
        return url(Storage::url($value));
    }


}
