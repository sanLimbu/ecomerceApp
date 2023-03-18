<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Product;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table = "category_product";
    protected $fillable = ["category_id","product_id"];

    public function category()
     {
        return $this->belongsTo(Category::class);
     }

    public function product()
     {
        return $this->belongsTo(Product::class);
     } 
}
