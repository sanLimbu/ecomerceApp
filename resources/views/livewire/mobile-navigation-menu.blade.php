<div x-data="{ open: false }">

    <button @click="open = true" type="button" class="rounded-md bg-white p-2 text-gray-400 lg:hidden">
        <span class="sr-only">Open menu</span>
        <!-- Heroicon name: outline/bars-3 -->
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
       <div  x-show="open"  @click.outside="open=false" class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black bg-opacity-25"></div>
        <div class="fixed inset-0 z-40 flex">
          <div class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl">
            <div  class="flex px-4 pt-5 pb-2">
              <button @click="open=false"   
              class="-m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400"
              >
                <span class="sr-only">Close menu</span>
                <!-- Heroicon name: outline/x-mark -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            <!-- Links -->
            <div  class="mt-2">
              <div class="border-b border-gray-200">
                <div class="-mb-px flex space-x-8 px-4" aria-orientation="horizontal" role="tablist">
                  <!-- Selected: "text-indigo-600 border-indigo-600", Not Selected: "text-gray-900 border-transparent" -->
                  <button id="tabs-1-tab-1" class="text-gray-900 border-transparent flex-1 whitespace-nowrap border-b-2 py-4 px-1 text-base font-medium" aria-controls="tabs-1-panel-1" role="tab" type="button">
                    Women</button>
                </div>
              </div>
    
              <!-- 'Women' tab panel, show/hide based on tab state. -->
              <div id="tabs-1-panel-1" class="space-y-10 px-4 pt-10 pb-8" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
                <div class="grid grid-cols-2 gap-x-4">
                  <div class="group relative text-sm">
                    <div class="aspect-w-1 aspect-h-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75">
                      <img src="https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg" alt="Models sitting back to back, wearing Basic Tee in black and bone." class="object-cover object-center">
                    </div>
                    <a href="#" class="mt-6 block font-medium text-gray-900">
                      <span class="absolute inset-0 z-10" aria-hidden="true"></span>
                      New Arrivals
                    </a>
                    <p aria-hidden="true" class="mt-1">Shop now</p>
                  </div>
    
                  <div class="group relative text-sm">
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
                @foreach($categories as $category) 
                <div>
                  <a href="/categories/{{ $category->slug }}" class="{{ $category->depth == 0 ? 'font-bold' : ''}}">   {{ $category->title }} </a>

                  <ul role="list" aria-labelledby="women-clothing-heading-mobile" class="mt-6 flex flex-col space-y-6">
                    @foreach($category->children as $child)
                    <li class="flow-root">
                      <a href="/categories/{{ $child->slug }}" class="-m-2 block p-2 text-gray-500">{{ $child->title }}</a>
                    </li>
                    @endforeach
                  </ul>
                </div>
                @endforeach
              </div> 
            </div>
            <div class="space-y-6 border-t border-gray-200 py-6 px-4">
                <div class="flow-root">
                    <a href="/orders" class="-m-2 block p-2 font-medium text-gray-900">Orders</a>
                  </div>
                  @guest  
                <div class="flow-root">
                <a href="/login" class="-m-2 block p-2 font-medium text-gray-900">Sign in</a>
              </div>
              <div class="flow-root">
                <a href="/register" class="-m-2 block p-2 font-medium text-gray-900">Create account</a>
              </div>
              @endguest
              @auth
              <div class="flow-root">
                <a class="-m-2 block p-2 font-medium text-gray-900">{{ Auth::user()->name }}</a>
              </div>
              <div class="flow-root">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf

                  <x-dropdown-link :href="route('logout')"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();">
                      {{ __('Log Out') }}
                  </x-dropdown-link>
              </form> 
              </div>
              @endauth
            </div>
          </div>
        </div>
      </div>
</div>