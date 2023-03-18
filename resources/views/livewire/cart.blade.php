@if (!$cart->isEmpty())
<div class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
    <section aria-labelledby="cart-heading" class="lg:col-span-7">
      <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

      <ul role="list" class="divide-y divide-gray-200 border-t border-b border-gray-200">
        @foreach($cart->contents() as $variation) 
        @livewire('cart-item', ['variation' => $variation, 'key' => $variation->id ])
       
    @endforeach
           
      </ul>
    </section>

    <!-- Order summary -->
    <section aria-labelledby="summary-heading" class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
      <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

      <dl class="mt-6 space-y-4">
        <div class="flex items-center justify-between">
          <dt class="text-sm text-gray-600">Subtotal</dt>
          <dd class="text-sm font-medium text-gray-900">{{ $cart->formattedSubtotal()}}</dd>
        </div>

      </dl>

      <div class="mt-6">
      <x-button-anchor href="/checkout">Checkout</x-button-anchor>      
      </div>
    </section>
</div>


  @else

  <section aria-labelledby="summary-heading" class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Your Cart is Empty</h2>
  </section>

@endif  