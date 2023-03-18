<div class="pt-12 pb-24 lg:grid lg:grid-cols-3 lg:gap-x-8 xl:grid-cols-4">
    <aside>
 
     
      <div class="hidden lg:block">
        <form class="space-y-10 divide-y divide-gray-200">
        
          @if ($products->count())
          <div>
            <fieldset>
              <legend class="block text-sm font-medium text-gray-900">Max Price &nbsp;({{ money($priceRange['max']) }})</legend>
              <div class="space-y-3 pt-6">
                <div class="flex items-center">
                  <input type="range" min="0" max="{{ $maxPrice }}" wire:model="priceRange.max">
                </div>
              </div>
            </fieldset>
          </div> 
          @endif

          @foreach($filters as $title => $filter)
          <div>
            <fieldset>
              <legend class="block text-sm font-medium text-gray-900">{{ Str::title($title) }}</legend>
              <div class="space-y-3 pt-6">
               @foreach( $filter as $option => $count)
                <div class="flex items-center">
                  <input type="checkbox" wire:model="queryFilters.{{ $title }}" id="{{$title}}_{{strtolower($option)}}" value="{{ $option }}" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                  <label for="{{$title}}_{{strtolower($option)}}" class="ml-3 text-sm text-gray-600">{{ $option }}&nbsp;({{ $count }})</label>
                </div>
                @endforeach
              </div>
            </fieldset>
          </div>
          @endforeach
        </form>
      </div>
    </aside>

<section aria-labelledby="product-heading" class="mt-6 lg:col-span-2 lg:mt-0 xl:col-span-3">
    <h2 id="product-heading" class="sr-only">Products</h2>
    <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:gap-x-8 xl:grid-cols-3">
      @foreach($products as $product)  
      <div class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white">
        <div class="aspect-w-3 aspect-h-4 bg-gray-200 group-hover:opacity-75 sm:aspect-none sm:h-96">
          <img src="{{ $product->getFirstMediaUrl() }}" alt="Front of plain black t-shirt." class="h-full w-full object-cover object-center sm:h-full sm:w-full">
        </div>
        <div class="flex flex-1 flex-col space-y-2 p-4">
          <h3 class="text-sm font-medium text-gray-900">
            <a href="/products/{{ $product->slug }}">
              <span aria-hidden="true" class="absolute inset-0"></span>
             {{ $product->title }}
            </a>
          </h3>
           <p class="text-sm text-gray-500">{{ $product->description}}</p> 
          <div class="flex flex-1 flex-col justify-end">
            <p class="text-base font-medium text-gray-900">{{ $product->formattedPrice()}}</p>
          </div>
        </div>
      </div>
      @endforeach
      <!-- More products... -->
    </div>
  </section>
</div>
