<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Cart\Contracts\CartInterface;
class CartMiddleware
{
   
    public function __construct(protected CartInterface $cart) {}


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$this->cart->exists()) 
        {
            $this->cart->create($request->user());
        }

        return $next($request);
    }
}
