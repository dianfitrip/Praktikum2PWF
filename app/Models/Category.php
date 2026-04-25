<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Mengizinkan kolom 'name' untuk diisi melalui form (mass assignment)
    protected $fillable = ['name'];

    // Membuat Relasi: 1 Kategori bisa memiliki banyak (hasMany) Produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
