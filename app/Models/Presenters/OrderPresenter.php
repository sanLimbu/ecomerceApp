<?php


namespace App\Models\Presenters;
use App\Models\Order;

class OrderPresenter

{
    public function __construct(protected Order $order) { }

    public function status()
    {
        return match ($this->order->status())
         {
            'placed_at' => '<div class="h-2 rounded-full bg-indigo-600" style="width: calc((1 * 2 + 1) / 8 * 100%)"></div>',
            'shipped_at' => '<div class="h-2 rounded-full bg-indigo-600" style="width: calc((1 * 2 + 3) / 8 * 100%)"></div>',
            default => ''
         };
    }
}

   
