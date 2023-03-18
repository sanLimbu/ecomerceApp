<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Variation;

class stock extends Model
{
    use HasFactory;

    protected $fillable = ["variation_id","amount"];

     public function variation(){
        return $this->belongsTo(Variation::class);
    }
}
