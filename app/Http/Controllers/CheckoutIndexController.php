<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\RedirectIfCartEmpty;
use App\Cart\Exceptions\QuantityNoLongerAvailable;
use App\Cart\Contracts\CartInterface;

class CheckoutIndexController extends Controller
{

    public function __construct()
     {
        $this->middleware(RedirectIfCartEmpty::class);
     }
    public function __invoke(CartInterface $cart)
    {
        try {
            $cart->verifyAvailableQuantities();
          }catch(QuantityNoLongerAvailable $e) {
             $cart->syncAvailableQuantities();
          }

        return view('checkout');
    }
}
