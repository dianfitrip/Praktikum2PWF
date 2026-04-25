<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'qty',
        'price',
        'category_id' //tambahkan ini untuk category UCP1
    ];

    // Menambahkan ": BelongsTo" di akhir fungsi
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: model ini memiliki satu category (belongsTo)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}