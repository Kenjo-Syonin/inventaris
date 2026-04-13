<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom untuk diisi
    protected $guarded = []; 

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}