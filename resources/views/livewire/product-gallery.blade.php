    <div class="flex flex-col-reverse">
        <!-- Image selector -->
        <div class="mx-auto mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none">
          <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
            @foreach($product->getMedia() as $media)
            <button wire:click="selectImage('{{  $media->getUrl() }}')" id="tabs-1-tab-1" class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4" aria-controls="tabs-1-panel-1" role="tab" type="button">
              <span class="sr-only"> Angled view </span>
              <span class="absolute inset-0 overflow-hidden rounded-md">
                <img src="{{ $media->getUrl('preview')}}" alt="" class="h-full w-full object-cover object-center">
              </span>
              <!-- Selected: "ring-indigo-500", Not Selected: "ring-transparent" -->
              <span class="ring-transparent pointer-events-none absolute inset-0 rounded-md ring-2 ring-offset-2" aria-hidden="true"></span>
            </button>
            @endforeach
            <!-- More images... -->
          </div>
        </div>
      

        <div class="aspect-w-1 aspect-h-1 w-full">
          <!-- Tab panel, show/hide based on tab state. -->
          <div id="tabs-1-panel-1" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
            <img src="{{ $selectedImageUrl }}" alt="Angled front view with bag zipped and handles upright." class="h-full w-full object-cover object-center sm:rounded-lg">
          </div>

          <!-- More images... -->
        </div>
      </div>

