<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use App\Models\Product;
use App\Models\Stock;
use App\Models\VariationType;

use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Akaunting\Money\Money;

use Spatie\MediaLibrary\InteractsWithMedia;


class Variation extends Model implements HasMedia
{ 
    use HasFactory;
    use HasRecursiveRelationships;
    use InteractsWithMedia;

    protected $fillable =  ["product_id","variation_types_id","title","price","type","sku",
                            "parent_id","order"];



    public function formattedPrice()
     {
         return Money::USD($this->price);
     }

     public function inStock()
       {
        return $this->stockCount() > 0;
       }

    public function outOfStock()
      {
        return !$this->inStock();
      }   

     public function stockCount()
     {
        return $this->descendantsAndSelf->sum(fn ($variation) => 
            $variation->stocks->sum('amount')
     );
     }

     public function stocks()
     {
        return $this->hasMany(Stock::class);
     }


    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function variationType()
    {
       return $this->belongsTo(VariationType::class);
    }


    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 200, 200)
            ->nonQueued();
    }

    public function registerMediaCollections() : void 
    {
        $this->addMediaCollection('default')
            ->useFallbackUrl(url('/storage/no-product-image.jpeg'));
    }
}


