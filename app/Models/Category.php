<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;

    protected $fillable =  ["title","slug","parent_id"];


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
