<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Warehouse extends Model
{
    protected $fillable = [
        'name',
        'address',
        'photo',
        'phone',
    ];

    // Relasi: Many-to-Many dengan Product (Stock fisik)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'warehouse_products')
            ->withPivot('stock')
            ->withTimestamps();
    }
    // Accessor untuk mengubah thumbnail menjadi URL publik
    public function getPhotoAttribute($value){
        if (!$value) {
            return null;
        }
        return url(Storage::url($value));
    }     
}
