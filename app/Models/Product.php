<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // Add this line

    protected $fillable = ['name', 'category_id', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
