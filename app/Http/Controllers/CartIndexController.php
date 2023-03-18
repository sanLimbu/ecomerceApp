<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart\Contracts\CartInterface;
use App\Cart\Exceptions\QuantityNoLongerAvailable;

class CartIndexController extends Controller
{
    public function __invoke(CartInterface $cart)
    {

        try {
           $cart->verifyAvailableQuantities();
         }catch(QuantityNoLongerAvailable $e) {

            session()->flash('notification','some items or quantities in your cart have been unavailable.');

            $cart->syncAvailableQuantities();
         }
        return view('cart.index');
    }
}
