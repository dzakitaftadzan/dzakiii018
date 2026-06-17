<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- TAMBAHKAN BARIS INI
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'category_id',
    ];
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
