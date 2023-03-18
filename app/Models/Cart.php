<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Variation;
use Illuminate\Support\Str;

class cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_intent_id'
    ];


    public static function booted()
    {
        static::creating(function ($model) {

            $model->uuid = (string) Str::uuid();
        });
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class)
            ->withPivot('quantity')
            ->orderBy('id');
    }
}
