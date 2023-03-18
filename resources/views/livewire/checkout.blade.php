<form  x-on:submit.prevent="submit" 

x-data="{

    stripe: null,
    cardElement: null,
    email: @entangle('accountForm.email').defer,

    async submit() {
      await $wire.callValidate()
      let errorCount = await $wire.getErrorCount()
      if (errorCount >= 1) 
       {
        return 
       }

      const { paymentIntent, error } = await this.stripe.confirmCardPayment(
        '{{ $paymentIntent->client_secret }}',{
        payment_method: {
          card: this.cardElement,
          billing_details: { email: this.email }
        }
        }
      )

      if (error)
        {
            window.dispatchEvent(new CustomEvent('notification', {
              detail: { 
                      body: error.message,
                      timeout: 5000
              }
            }))
          } 
       else 
        {
           $wire.checkout()
        }

    },

    init() {
      this.stripe = Stripe('{{ config('stripe.key') }}')
      const elements = this.stripe.elements()
      this.cardElement = elements.create('card')
      this.cardElement.mount('#card-element')
    }

  }"

class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
    <div>
      @guest 
      <div>
        <h2 class="text-lg font-medium text-gray-900">Contact information</h2>
        <div class="mt-4">
          <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
          <div class="mt-1">
            <input type="email" id="email-address" wire:model.defer="accountForm.email" name="email-address" autocomplete="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
          </div>
          @error('accountForm.email')
          <div class="mt-1 font-semibold text-red-600">
            {{ $message }}
          </div> 
          @enderror 
        </div>
      </div>
      @endguest  

      <div class="mt-10 border-t border-gray-200 pt-10">
        <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>

        <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
         @if($this->userShippingAddresses)
          <div class="sm:col-span-2">
            {{-- <label for="country" class="block text-sm font-medium text-gray-700">Country</label> --}}
            <div class="mt-1">
              <x-select  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
              wire:model="userShippingAddressId">
                <option value="" disabled>Choose a pre-save address</option>
                @foreach($this->userShippingAddresses as $address)
                <option value="{{ $address->id }}">{{ $address->formattedAddress()}}</option>
                @endforeach
              </x-select>
            </div>
          </div>
          @endif
          <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
            <div class="mt-1">
              <input type="text" wire:model.defer="shippingForm.first_name" id="first_name" name="first_name" autocomplete="given-name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('shippingForm.first_name')
              <div class="mt-1 font-semibold text-red-600">
                  {{ $message }}
              </div> 
            @enderror 
          </div>

          <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
            <div class="mt-1">
              <input type="text" wire:model.defer="shippingForm.last_name" id="last_name" name="last_name" autocomplete="family-name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('shippingForm.last_name')
            <div class="mt-1 font-semibold text-red-600">
                {{ $message }}
            </div> 
          @enderror 
          </div>

          <div >
            <label for="house_number" class="block text-sm font-medium text-gray-700">House Number</label>
            <div class="mt-1">
              <input type="text" wire:model.defer="shippingForm.house_number" name="house_number" id="house_number" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('shippingForm.house_number')
            <div class="mt-1 font-semibold text-red-600">
                {{ $message }}
            </div> 
          @enderror 
          </div>

          <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <div class="mt-1">
              <input type="text" wire:model.defer="shippingForm.address" name="address" id="address" autocomplete="street-address" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('shippingForm.address')
            <div class="mt-1 font-semibold text-red-600">
                {{ $message }}
            </div> 
          @enderror 
          </div>

          

          <div>
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <div class="mt-1">
              <input type="text" wire:model.defer="shippingForm.city" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('shippingForm.city')
            <div class="mt-1 font-semibold text-red-600">
                {{ $message }}
            </div> 
          @enderror 
          </div>

          <div>
            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
            <div class="mt-1">
              <select id="country" wire:model.defer="shippingForm.country" name="country" autocomplete="country-name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="us">United States</option>
                <option value="ca">Canada</option>
                <option value="mx">Mexico</option>
                <option value="uk">United Kingdom</option>
              </select>
            </div>
          </div>

          <div>
            <label for="post_code" class="block text-sm font-medium text-gray-700">Postal code</label>
            <div class="mt-1">
              <input type="text" wire:model.defer="shippingForm.post_code" name="post_code" id="post_code" autocomplete="postal-code" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('shippingForm.post_code')
              <div class="mt-1 font-semibold text-red-600">
                  {{ $message }}
              </div> 
            @enderror 
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <div class="mt-1">
              <input type="text"  wire:model.defer="shippingForm.phone" name="phone" id="phone" autocomplete="tel" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('shippingForm.phone')
            <div class="mt-1 font-semibold text-red-600">
                {{ $message }}
            </div> 
          @enderror 
          </div>
        </div>
      </div>

      <div class="mt-10 border-t border-gray-200 pt-10">
        <fieldset>
          <legend class="text-lg font-medium text-gray-900">Delivery method</legend>
          {{ $shippingTypeId }}
          <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
            <!--
              Checked: "border-transparent", Not Checked: "border-gray-300"
              Active: "ring-2 ring-indigo-500"
            -->
          
            @foreach($shippingTypes as $shippingType)
            
            <label wire:model="shippingTypeId" class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none">
              <input type="radio" name="delivery-method" value="{{ $shippingType->id }}" class="sr-only" aria-labelledby="delivery-method-0-label" aria-describedby="delivery-method-0-description-0 delivery-method-0-description-1">
              <span class="flex flex-1">
                <span class="flex flex-col">
                  <span id="delivery-method-0-label" class="block text-sm font-medium text-gray-900">{{ $shippingType->title }}</span>
                  <span id="delivery-method-0-description-0" class="mt-1 flex items-center text-sm text-gray-500">4–10 business days</span>
                  <span id="delivery-method-0-description-1" class="mt-6 text-sm font-medium text-gray-900">{{ money($shippingType->price) }}</span>
                </span>
              </span>
              <!--
                Not Checked: "hidden"

                Heroicon name: mini/check-circle
              -->
              <svg class="h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
              </svg>
              <!--
                Active: "border", Not Active: "border-2"
                Checked: "border-indigo-500", Not Checked: "border-transparent"
              -->
              <span class="pointer-events-none absolute -inset-px rounded-lg border-2" aria-hidden="true"></span>
            </label>
            @endforeach
            <!--
              Checked: "border-transparent", Not Checked: "border-gray-300"
              Active: "ring-2 ring-indigo-500"
            -->
          
          </div>
        </fieldset>
      </div>

      <!-- Payment -->
       <div class="mt-10 border-t border-gray-200 pt-10">
        <h2 class="text-lg font-medium text-gray-900">Payment</h2>
         <div wire:ignore id="card-element"> </div>
      </div> 
    </div>

    <!-- Order summary -->
    <div class="mt-10 lg:mt-0">
      <h2 class="text-lg font-medium text-gray-900">Order summary</h2>

      <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
        <h3 class="sr-only">Items in your cart</h3>
        <ul role="list" class="divide-y divide-gray-200">
            @foreach($cart->contents() as $variation)
          <li class="flex py-6 px-4 sm:px-6">
            <div class="flex-shrink-0">
              <img src="{{ $variation->getFirstMediaUrl('default','preview')}}" alt="Front of men&#039;s Basic Tee in black." class="w-20 rounded-md">
            </div>

            <div class="ml-6 flex flex-1 flex-col">
              <div class="flex">
                <div class="min-w-0 flex-1">
                  <h4 class="text-sm">
                    <a href="#" class="font-medium text-gray-700 hover:text-gray-800">{{ $variation->product->title }}</a>
                  </h4>
                  @foreach($variation->ancestorsAndSelf as $ancestor)
                  <p class="mt-1 text-sm text-gray-500">{{ $ancestor->title }}</p>
                  @endforeach 
                </div>

                <div class="ml-4 flow-root flex-shrink-0">
                  <button type="button" class="-m-2.5 flex items-center justify-center bg-white p-2.5 text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Remove</span>
                    <!-- Heroicon name: mini/trash -->
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </div>

              <div class="flex flex-1 items-end justify-between pt-2">
                <p class="mt-1 text-sm font-medium text-gray-900">{{ money($variation->formattedPrice()) }}</p>

                <div class="ml-4">
                  <label for="quantity" class="sr-only">{{ $variation->pivot->quantity }}</label>
                  <select id="quantity" name="quantity" class="rounded-md border border-gray-300 text-left text-base font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                    <option value="{{ $variation->pivot->quantity }}">{{ $variation->pivot->quantity }}</option>
                  </select>
                </div>
              </div>
            </div>
          </li>
         @endforeach 
          <!-- More products... -->
        </ul>
        <dl class="space-y-6 border-t border-gray-200 py-6 px-4 sm:px-6">
          <div class="flex items-center justify-between">
            <dt class="text-sm">Subtotal</dt>
            <dd class="text-sm font-medium text-gray-900">{{ money($cart->subtotal()) }}</dd>
          </div>
          <div class="flex items-center justify-between">
            <dt class="text-sm">Shipping ({{ $this->shippingType->title }})</dt>
            <dd class="text-sm font-medium text-gray-900">{{ money($this->shippingType->price) }}</dd>
          </div>
       
          <div class="flex items-center justify-between border-t border-gray-200 pt-6">
            <dt class="text-base font-medium">Total</dt>
            <dd class="text-base font-medium text-gray-900">{{ money($this->total) }}</dd>
          </div>
        </dl>

        <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
          <button type="submit" class="w-full rounded-md border border-transparent bg-indigo-600 py-3 px-4 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Confirm order</button>
        </div>
      </div>
    </div>
  </form>
