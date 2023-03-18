<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
       
        'first_name' ,
        'last_name',
        'address',
        'house_number',
        'city',
        'country' ,
        'post_code',
        'phone' 

    ];


    public function user()
     {
        return $this->belongsTo(User::class);
     }


     public function formattedAddress()
      {
        return sprintf('%s,%s,%s,%s,%s,%s,%s,%s',

            $this->first_name ,
            $this->last_name,
            $this->address,
            $this->house_number,
            $this->city,
            $this->country ,
            $this->post_code,
            $this->phone 

        );
      }
}
