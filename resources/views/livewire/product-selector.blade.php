<div class="space-y-6">
    {{-- The whole world belongs to you. --}}
    @if ($initialVariation)
      {{-- <livewire:product-drop-down :variations="$initialVariation" /> --}}
      @livewire('product-drop-down', ['variations' => $initialVariation])
    @endif
  
    @if($skuVariant)

    <div class="font-semibold text-lg">
      {{ $skuVariant->formattedPrice() }}
    </div>
    
    <div class="sm:flex-col1 mt-10 flex">
      
      <button wire:click.prevent="addToCart" type="submit" class="flex max-w-xs flex-1 items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full">Add to bag</button>
    </div> 
    @endif
</div>
