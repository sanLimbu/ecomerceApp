<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Cart\Contracts\CartInterface;

class RedirectIfCartEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     public function __construct(protected CartInterface $cart) {}

    public function handle(Request $request, Closure $next)
    {
        if ($this->cart->isEmpty())
         {
            return redirect()->route('cart');
         }
        return $next($request);
    }
}
