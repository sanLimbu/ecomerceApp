<x-app-layout>
<div class="bg-white">
      <div class="border-b border-gray-200">
        <nav aria-label="Breadcrumb" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <ol role="list" class="flex items-center space-x-4 py-4">
          @foreach($category->ancestors->reverse() as $ancestors)
            <li>
              <div class="flex items-center">
                <a href="/categories/{{ $ancestors->slug }}" class="mr-4 text-sm font-medium text-gray-900">{{ $ancestors->title }}</a>
                <svg viewBox="0 0 6 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-auto text-gray-300">
                  <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z" fill="currentColor" />
                </svg>
              </div>
            </li>
           @endforeach 
          </ol>
        </nav>
      </div>
      <main class="mx-auto max-w-2xl px-4 lg:max-w-7xl lg:px-8">
        <div class="border-b border-gray-200 pt-24 pb-10">
          <h1 class="text-4xl font-bold tracking-tight text-gray-900">{{ $category->title }}</h1>
          <p class="mt-4 text-base text-gray-500">Checkout out the latest release of Basic Tees, new and improved with four openings!</p>
        </div>
        <livewire:product-browser :category="$category"/>
      </main>
  </div>
</x-app-layout>