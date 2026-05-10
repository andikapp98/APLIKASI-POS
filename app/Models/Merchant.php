<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'photo',
        'phone',
        'keeper_id' // Menghubungkan Merchant dengan User (Keeper)
    ];

    // Merchant terhubung dengan user melalui foreign key keeper_id
    public function keeper(){
        return $this->belongsTo(User::class, 'keeper_id');
    }

    //Relasi dengan Product melalui tabel pivot merchant_products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'merchant_products')
            ->withPivot('stock', 'warehouse_id') // mengambil kolom 'stock' dan tabel pivot
            ->withTimestamps();
    }
    
    // Relasi dengan Transaction
    public function transaction(){
        return $this->hasMany(Transaction::class);
    }


}
