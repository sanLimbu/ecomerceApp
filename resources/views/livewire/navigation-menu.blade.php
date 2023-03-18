
    <div class="hidden lg:ml-8 lg:block lg:self-stretch">
        <div class="flex h-full space-x-8">
         
        <div class="flex">
            <div class="relative flex  transition hamburger"  wire:click="$toggle('showDiv')">
            <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
            <button type="button" class="border-transparent text-gray-700 hover:text-gray-800 relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out" aria-expanded="false">Shop</button>
            </div>
            @if ($showDiv) 
            <div x-on:click.away="if($wire.get('showDiv')==true) { $wire.hideDiv() }"  class="absolute inset-x-0 top-full text-sm text-gray-500">
            <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
            <div class="absolute inset-0 top-1/2 bg-white shadow" aria-hidden="true"></div>

            <div class="relative bg-white" >
                <div class="mx-auto max-w-7xl px-8">
                <div class="grid grid-cols-2 gap-y-10 gap-x-8 py-16">
                    <div class="col-start-2 grid grid-cols-2 gap-x-8">
                    <div class="group relative text-base sm:text-sm">
                        <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                        <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg" alt="Models sitting back to back, wearing Basic Tee in black and bone." class="object-cover object-center">
                        </div>
                        <a href="#" class="mt-6 block font-medium text-gray-900">
                        <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                        New Arrivals
                        </a>
                        <p aria-hidden="true" class="mt-1">Shop now</p>
                    </div>

                    <div class="group relative text-base sm:text-sm">
                        <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                        <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-02.jpg" alt="Close up of Basic Tee fall bundle with off-white, ochre, olive, and black tees." class="object-cover object-center">
                        </div>
                        <a href="#" class="mt-6 block font-medium text-gray-900">
                        <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                        Basic Tees
                        </a>
                        <p aria-hidden="true" class="mt-1">Shop now</p>
                    </div>
                    </div>
                    <div class="row-start-1 grid grid-cols-3 gap-y-10 gap-x-8 text-sm">
                       
                    {{-- <div>
                       @foreach ($categories as $category) 
                             <x-category :category="$category" />
                        @endforeach
                    </div>                     --}}
                  
                   @foreach($categories as $category) 
                    <div>
                        <a href="/categories/{{ $category->slug }}" class="{{ $category->depth == 0 ? 'font-bold' : ''}}">   {{ $category->title }} </a>

                        <ul role="list" aria-labelledby="Accessories-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                        @foreach($category->children as $child)
                         <li class="flex">
                            <a href="/categories/{{ $child->slug }}" class="hover:text-gray-800">{{ $child->title }}</a>
                         </li>
                         @endforeach
                        </ul>
                    </div>
                   @endforeach 
                    </div>
                </div>
                </div>
            </div>
            </div>
           @endif 
        </div>
        </div>
    </div> 
