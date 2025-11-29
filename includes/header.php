  <!-- Header section -->
  <header class="sticky top-0 z-30 bg-gray-800 py-4 px-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 lg:gap-6">


      <!-- Mobile: hamburger menu, logo, and sign-in button -->
      <div class="flex items-center justify-between w-full lg:w-auto">

        <!-- Hamburger menu -->
        <button id="mobile-menu-btn" class="sm:hidden p-2 text-white hover:bg-gray-700 rounded transition">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>

        <!-- Logo -->
        <a href="https://www.pixahunt.com/"><img class="w-[130px] flex-shrink-0 hidden" src="assets/logo/freepik-logo.png" alt="freepik-logo"></a>


        <!-- Sign-in button-->
        <button class="lg:hidden text-white rounded px-5 py-2 border border-gray-600 transition flex-shrink-0">
          Sign in
        </button>
      </div>


      <!-- Search bar -->
      <div class="w-full lg:flex-1 lg:max-w-2xl lg:mx-auto">
        <div class="relative w-full">
          <!-- Search input field -->
          <input type="search" class="bg-gray-700 rounded-full pl-12 pr-24 py-2 text-white focus:outline-none w-full"
            placeholder="Search assets or start creating">

          <!-- Search icon -->
          <svg
            class="absolute left-5 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400 hover:text-white hover:bg-gray-700 rounded cursor-pointer transition duration-200"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
          </svg>

          <!-- Camera icon -->
          <svg
            class="absolute right-5 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400 hover:text-white hover:bg-gray-700 rounded cursor-pointer transition duration-200"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
          </svg>

          <!-- Vertical line icon -->
          <svg class="absolute right-12 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
          </svg>

          <!-- Cross icon -->
          <svg
            class="absolute right-20 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400 hover:text-white hover:bg-gray-700 rounded cursor-pointer transition duration-200 hidden"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </div>
      </div>

      <!-- Desk: sign-in button-->
      <button
        class="hidden lg:block text-white rounded px-5 py-2 border border-gray-400 hover:bg-gray-600 transition flex-shrink-0">
        Sign in
      </button>
    </div>

    <!-- Mobile navigation and filters -->
    <div class="px-6 mt-5">

      <!-- Mobile navigation buttons -->
      <div id="mobile-nav-buttons" class="hidden max-sm:flex border border-gray-700 overflow-hidden mb-4 -mx-6 relative">
        <!-- "All Images" button -->
        <button id="mobile-all-images-btn"
          class="flex-1 px-4 py-3 text-white text-sm font-semibold hover:bg-gray-600 transition border-r border-gray-600 flex items-center justify-center gap-2">
          <span id="mobile-all-images-text">All Images</span>
          <svg id="mobile-all-images-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 transition-transform">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
          </svg>
        </button>

        <!-- "Filters" button -->
        <button id="mobile-filters-btn"
          class="flex-1 px-4 py-3 text-white text-sm font-semibold hover:bg-gray-600 transition">
          Filters
        </button>
      </div>

      <!-- Mobile: "All Images" dropdown popup -->
      <div id="mobile-all-images-dropdown"
        class="hidden absolute bg-gray-900 z-50 shadow-lg"
        style="top: 100%; width: 50%; left: 25px;">
        <div class="py-2">
          <label class="mobile-category-option w-full px-4 py-3 text-white text-sm transition flex items-center justify-between cursor-pointer" data-category="all-images">
            <span>All Images</span>
            <input type="radio" name="mobile-category" value="all-images" class="w-4 h-4 text-green-500 focus:ring-green-500 focus:ring-2" checked>
          </label>
          <label class="mobile-category-option w-full px-4 py-3 text-gray-400 text-sm hover:text-white transition flex items-center justify-between cursor-pointer" data-category="vectors">
            <span>Vectors</span>
            <input type="radio" name="mobile-category" value="vectors" class="w-4 h-4 text-green-500 focus:ring-green-500 focus:ring-2">
          </label>
          <label class="mobile-category-option w-full px-4 py-3 text-gray-400 text-sm hover:text-white transition flex items-center justify-between cursor-pointer" data-category="illustrations">
            <span>Illustrations</span>
            <input type="radio" name="mobile-category" value="illustrations" class="w-4 h-4 text-green-500 focus:ring-green-500 focus:ring-2">
          </label>
          <label class="mobile-category-option w-full px-4 py-3 text-gray-400 text-sm hover:text-white transition flex items-center justify-between cursor-pointer" data-category="photos">
            <span>Photos</span>
            <input type="radio" name="mobile-category" value="photos" class="w-4 h-4 text-green-500 focus:ring-green-500 focus:ring-2">
          </label>
          <label class="mobile-category-option w-full px-4 py-3 text-gray-400 text-sm hover:text-white transition flex items-center justify-between cursor-pointer" data-category="icons">
            <span>Icons</span>
            <input type="radio" name="mobile-category" value="icons" class="w-4 h-4 text-green-500 focus:ring-green-500 focus:ring-2">
          </label>
          <label class="mobile-category-option w-full px-4 py-3 text-gray-400 text-sm hover:text-white transition flex items-center justify-between cursor-pointer" data-category="videos">
            <span>Videos</span>
            <input type="radio" name="mobile-category" value="videos" class="w-4 h-4 text-green-500 focus:ring-green-500 focus:ring-2">
          </label>
          <label class="mobile-category-option w-full px-4 py-3 text-gray-400 text-sm hover:text-white transition flex items-center justify-between cursor-pointer" data-category="psd">
            <span>PSD</span>
            <input type="radio" name="mobile-category" value="psd" class="w-4 h-4 text-green-500 focus:ring-green-500 focus:ring-2">
          </label>
          <label class="mobile-category-option w-full px-4 py-3 text-gray-400 text-sm hover:text-white transition flex items-center justify-between cursor-pointer" data-category="templates">
            <span>Templates</span>
            <input type="radio" name="mobile-category" value="templates" class="w-4 h-4 text-green-500 focus:ring-green-500 focus:ring-2">
          </label>
          <label class="mobile-category-option w-full px-4 py-3 text-gray-400 text-sm hover:text-white transition flex items-center justify-between cursor-pointer" data-category="mockups">
            <span>Mockups</span>
            <input type="radio" name="mobile-category" value="mockups" class="w-4 h-4 text-green-500 focus:ring-green-500 focus:ring-2">
          </label>
          <label class="mobile-category-option w-full px-4 py-3 text-gray-400 text-sm hover:text-white transition flex items-center justify-between cursor-pointer" data-category="3d-models">
            <span>3D Models</span>
            <input type="radio" name="mobile-category" value="3d-models" class="w-4 h-4 text-green-500 focus:ring-green-500 focus:ring-2">
          </label>
          <label class="mobile-category-option w-full px-4 py-3 text-gray-400 text-sm hover:text-white transition flex items-center justify-between cursor-pointer" data-category="fonts">
            <span>Fonts</span>
            <input type="radio" name="mobile-category" value="fonts" class="w-4 h-4 text-green-500 focus:ring-green-500 focus:ring-2">
          </label>
        </div>
      </div>

      <!-- Mobile: Header Dimming Overlay -->
      <div id="mobile-header-dim" class="hidden fixed top-0 left-0 right-0 h-16 z-40 bg-black bg-opacity-50 sm:hidden"></div>

      <!-- Mobile: Full-Page Filter Overlay -->
      <div id="mobile-filter-overlay" class="hidden fixed top-16 left-0 right-0 bottom-0 z-50 bg-gray-900 sm:hidden flex flex-col">
        <!-- Filters Header (Title + Close Button) -->
        <div class="bg-gray-900 border-b border-gray-700 px-4 py-4 flex items-center justify-between flex-shrink-0">
          <h2 class="text-white text-lg font-semibold">Filters</h2>
          <button id="close-filter-overlay" class="p-2 text-white hover:bg-gray-700 rounded transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
              stroke="currentColor" class="h-6 w-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Filters Content (Scrollable) -->
        <div class="flex-1 overflow-y-auto p-4 pb-24">
          <div class="space-y-3">

            <!-- License filter -->
            <div class="relative w-full">
              <!-- License button -->
              <button id="mobile-license-btn"
                class="w-full flex items-center justify-between px-3 py-2 text-sm text-white hover:bg-gray-600 transition">
                <div class="flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                  </svg>
                  License
                </div>
                <svg class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
              </button>
              <!-- License popup -->
              <div id="mobile-license-popup" class="hidden w-full p-3 mobile-filter-popup">
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">All</span>
                  <input type="radio" name="mobile-license" value="all" class="text-green-500" checked>
                </label>
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">Free</span>
                  <input type="radio" name="mobile-license" value="free" class="text-green-500">
                </label>
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">Premium</span>
                  <input type="radio" name="mobile-license" value="premium" class="text-green-500">
                </label>
              </div>
            </div>

            <!-- AI-generated filter -->
            <div class="relative w-full">
              <!-- AI-generated button -->
              <button id="mobile-ai-btn"
                class="w-full flex items-center justify-between px-3 py-2 text-sm text-white hover:bg-gray-600 transition">
                <div class="flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                  </svg>
                  AI-generated
                </div>
                <svg class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
              </button>
              <!-- AI-generated popup -->
              <div id="mobile-ai-popup" class="hidden w-full p-3 mobile-filter-popup">
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">All</span>
                  <input type="radio" name="mobile-ai-type" value="show_all" class="text-green-500" checked>
                </label>
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">Exclude AI-generated</span>
                  <input type="radio" name="mobile-ai-type" value="exclude_ai" class="text-green-500">
                </label>
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">Only AI-generated</span>
                  <input type="radio" name="mobile-ai-type" value="only_ai" class="text-green-500">
                </label>
              </div>
            </div>

            <!-- Orientation filter -->
            <div class="relative w-full">
              <!-- Orientation button -->
              <button id="mobile-orientation-btn"
                class="w-full flex items-center justify-between px-3 py-2 text-sm text-white hover:bg-gray-600 transition">
                <div class="flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                  </svg>
                  Orientation
                </div>
                <svg class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
              </button>
              <!-- Orientation popup -->
              <div id="mobile-orientation-popup" class="hidden w-full p-3 mobile-filter-popup">
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">All</span>
                  <input type="radio" name="mobile-orientation" value="all" class="text-green-500" checked>
                </label>
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">Horizontal</span>
                  <input type="radio" name="mobile-orientation" value="horizontal" class="text-green-500">
                </label>
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">Vertical</span>
                  <input type="radio" name="mobile-orientation" value="vertical" class="text-green-500">
                </label>
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">Square</span>
                  <input type="radio" name="mobile-orientation" value="square" class="text-green-500">
                </label>
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">Panoramic</span>
                  <input type="radio" name="mobile-orientation" value="panoramic" class="text-green-500">
                </label>
              </div>
            </div>

            <!-- Color filter -->
            <div class="relative w-full">
              <!-- Color button -->
              <button id="mobile-color-btn"
                class="w-full flex items-center justify-between px-3 py-2 text-sm text-white hover:bg-gray-600 transition">
                <div class="flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" />
                  </svg>
                  Color
                </div>
                <svg class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
              </button>
              <!-- Color popup -->
              <div id="mobile-color-popup" class="hidden w-full p-3 mobile-filter-popup">
                <button data-color="all" class="w-full mb-2 px-4 py-2 text-white text-sm border border-gray-600 rounded hover:bg-gray-600">All Colors</button>
                <div class="grid grid-cols-6 gap-2">
                  <button data-color="red"
                    class="w-8 h-8 bg-red-500 border-2 border-gray-600 rounded-full cursor-pointer hover:border-white transition"></button>
                  <button data-color="orange"
                    class="w-8 h-8 bg-orange-400 border-2 border-gray-600 rounded-full cursor-pointer hover:border-white transition"></button>
                  <button data-color="yellow"
                    class="w-8 h-8 bg-yellow-400 border-2 border-gray-600 rounded-full cursor-pointer hover:border-white transition"></button>
                  <button data-color="green"
                    class="w-8 h-8 bg-green-500 border-2 border-gray-600 rounded-full cursor-pointer hover:border-white transition"></button>
                  <button data-color="blue"
                    class="w-8 h-8 bg-blue-500 border-2 border-gray-600 rounded-full cursor-pointer hover:border-white transition"></button>
                  <button data-color="purple"
                    class="w-8 h-8 bg-purple-500 border-2 border-gray-600 rounded-full cursor-pointer hover:border-white transition"></button>
                  <button data-color="pink"
                    class="w-8 h-8 bg-pink-500 border-2 border-gray-600 rounded-full cursor-pointer hover:border-white transition"></button>
                  <button data-color="gray"
                    class="w-8 h-8 bg-gray-300 border-2 border-gray-600 rounded-full cursor-pointer hover:border-white transition"></button>
                  <button data-color="black"
                    class="w-8 h-8 bg-black border-2 border-gray-600 rounded-full cursor-pointer hover:border-white transition"></button>
                  <button data-color="white"
                    class="w-8 h-8 bg-white border-2 border-gray-600 rounded-full cursor-pointer hover:border-blue-500 transition"></button>
                  <button data-color="teal"
                    class="w-8 h-8 bg-teal-400 border-2 border-gray-600 rounded-full cursor-pointer hover:border-white transition"></button>
                  <button data-color="lime"
                    class="w-8 h-8 bg-lime-400 border-2 border-gray-600 rounded-full cursor-pointer hover:border-white transition"></button>
                </div>
              </div>
            </div>

            <!-- Number of people filter -->
            <div class="relative w-full">
              <!-- Number of people button -->
              <button id="mobile-people-btn"
                class="w-full flex items-center justify-between px-3 py-2 text-sm text-white hover:bg-gray-600 transition">
                <div class="flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                  </svg>
                  Number of people
                </div>
                <svg class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
              </button>
              <!-- Number of people popup -->
              <div id="mobile-people-popup" class="hidden w-full p-3 mobile-filter-popup">
                <div class="flex flex-col gap-2">
                  <!-- All -->
                  <button data-people="all"
                    class="rounded px-4 py-2 hover:bg-gray-600 w-full text-center border border-gray-600 text-white">All</button>
                  <!-- No people -->
                  <button data-people="No,0"
                    class="rounded px-4 py-2 hover:bg-gray-600 w-full text-center border border-gray-600 text-white">No
                    people</button>

                  <!-- 1-4+ buttons -->
                  <div class="flex border border-gray-600">
                    <button data-people="1"
                      class="mobile-people-count-btn flex-1 hover:bg-gray-700 px-0 py-2 transition text-white text-sm border-r border-gray-600">1</button>
                    <button data-people="2"
                      class="mobile-people-count-btn flex-1 hover:bg-gray-700 px-0 py-2 transition text-white text-sm border-r border-gray-600">2</button>
                    <button data-people="3"
                      class="mobile-people-count-btn flex-1 hover:bg-gray-700 px-0 py-2 transition text-white text-sm border-r border-gray-600">3</button>
                    <button data-people="4+"
                      class="mobile-people-count-btn flex-1 hover:bg-gray-700 rounded-r-lg px-0 py-2 transition text-white text-sm">4+</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- File type filter -->
            <div class="relative w-full">
              <!-- File type button -->
              <button id="mobile-filetype-btn"
                class="w-full flex items-center justify-between px-3 py-2 text-sm text-white hover:bg-gray-600 transition">
                <div class="flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                  </svg>
                  File type
                </div>
                <svg class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
              </button>
              <!-- File type popup -->
              <div id="mobile-filetype-popup" class="hidden w-full p-3 mobile-filter-popup">
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">All</span>
                  <input type="radio" name="mobile-filetype" value="all" class="text-green-500" checked>
                </label>
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">PNG</span>
                  <input type="radio" name="mobile-filetype" value="1" class="text-green-500">
                </label>
                <label class="flex items-center justify-between p-2 hover:bg-gray-600 cursor-pointer transition">
                  <span class="text-white text-sm">JPG</span>
                  <input type="radio" name="mobile-filetype" value="2" class="text-green-500">
                </label>
              </div>
            </div>
          </div>
        </div>

        <!-- Apply and Clear Buttons (Fixed at Bottom) -->
        <div class="sticky bottom-0 left-0 right-0 bg-gray-900 border-t border-gray-700 p-4 flex-shrink-0">
          <div class="flex gap-3">
            <button id="clear-mobile-filters" class="flex-1 bg-gray-700 text-white font-semibold py-3 rounded-lg hover:bg-gray-600 transition hidden">
              Clear All
            </button>
            <button id="apply-mobile-filters" class="flex-1 bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition">
              Apply Filters
            </button>
          </div>
        </div>
      </div>


      <!-- Desktop Navigation -->
      <nav id="desktop-nav" class="text-gray-300 text-sm font-bold pb-1 max-sm:hidden">
        <div class="flex justify-between items-center">

          <!-- LEFT SIDE: Navigation items -->
          <ul id="navbar-menu" class="flex gap-4 overflow-hidden">
            <li class="nav-item whitespace-nowrap cursor-pointer hover:text-white transition">All Images</li>
            <li class="nav-item whitespace-nowrap cursor-pointer hover:text-white transition">Vectors</li>
            <li class="nav-item whitespace-nowrap cursor-pointer hover:text-white transition">Illustrations</li>
            <li class="nav-item whitespace-nowrap cursor-pointer hover:text-white transition">Photos</li>
            <li class="nav-item whitespace-nowrap cursor-pointer hover:text-white transition">Icons</li>
            <li class="nav-item whitespace-nowrap cursor-pointer hover:text-white transition">Videos</li>
            <li class="nav-item whitespace-nowrap cursor-pointer hover:text-white transition">PSD</li>
            <li class="nav-item whitespace-nowrap cursor-pointer hover:text-white transition">Templates</li>
            <li class="nav-item whitespace-nowrap cursor-pointer hover:text-white transition">Mockups</li>
            <li class="nav-item whitespace-nowrap cursor-pointer hover:text-white transition">3D Models</li>
            <li class="nav-item whitespace-nowrap cursor-pointer hover:text-white transition">Fonts</li>

            <!-- More button -->
            <li id="more-btn"
              class="nav-item whitespace-nowrap cursor-pointer relative hidden hover:text-white transition">
              More
              <svg class="inline-block ml-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
            </li>
          </ul>

          <!-- RIGHT SIDE: Filters and Relevance -->
          <ul class="flex gap-4 text-white">

            <!-- Filters button -->
            <li>
              <button
                class="flex items-center px-3 py-2 gap-2 text-sm text-white transition hover:text-gray-300 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                </svg>
                Filters
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="chevron h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>
              </button>
            </li>

            <!-- Relevance dropdown -->
            <li class="relative">
              <button
                class="flex items-center px-3 py-2 gap-2 text-sm text-white transition hover:text-gray-300 cursor-pointer">
                Relevance
                <svg id="relevance-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
              </button>

              <!-- Relevance popup -->
              <div id="relevance-popup"
                class="absolute top-[60px] right-0 bg-gray-900 border border-gray-700 rounded shadow-lg z-50 text-white font-normal p-4 hidden w-40">
                <label class="flex items-center mb-2 hover:bg-gray-600 px-4 py-2 rounded">
                  Relevance
                  <input type="radio" name="sort" value="relevance" class="ml-auto">
                </label>
                <label class="flex items-center hover:bg-gray-600 px-4 py-2 rounded">
                  Recent
                  <input type="radio" name="sort" value="recent" class="ml-auto">
                </label>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <hr class="border-t border-gray-500 max-sm:hidden">

      <!-- Filters section -->
      <div id="filters-section"
        class="overflow-x-auto whitespace-nowrap scrollbar-hide flex gap-4 text-white text-sm font-bold text-xs mt-3 max-sm:hidden">

        <!-- License filter -->
        <div class="relative inline-block">
          <button id="license-btn"
            class="flex items-center bg-gray-700 px-3 py-2 gap-2 rounded-lg text-sm text-white hover:bg-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
            </svg>
            License
            <svg id="license-chevron" xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 ml-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
              stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </button>

          <!-- License popup -->
          <div id="license-popup"
            class="absolute top-full left-0 mt-2 bg-gray-900 border border-gray-700 rounded z-50 text-white p-4 w-40 hidden">
            <label class="flex items-center mb-2 hover:bg-gray-600 px-4 py-2 rounded cursor-pointer">
              All
              <input type="radio" name="license" value="all" class="ml-auto" checked>
            </label>
            <label class="flex items-center mb-2 hover:bg-gray-600 px-4 py-2 rounded cursor-pointer">
              Free
              <input type="radio" name="license" value="free" class="ml-auto">
            </label>
            <label class="flex items-center hover:bg-gray-600 px-4 py-2 rounded cursor-pointer">
              Premium
              <input type="radio" name="license" value="premium" class="ml-auto">
            </label>
          </div>
        </div>

        <!-- AI-generated filter -->
        <div class="relative inline-block">
          <!-- AI-generated button -->
          <button id="ai-btn"
            class="flex items-center bg-gray-700 px-3 py-2 gap-2 rounded-lg text-sm text-white hover:bg-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
            </svg>
            AI-generated
            <svg id="ai-chevron" xmlns="http://www.w3.org/2000/svg"
              class="h-4 w-4 ml-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24"
              stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </button>

          <!-- AI-generated popup -->
          <div id="ai-popup"
            class="absolute top-full left-0 mt-2 bg-gray-900 border border-gray-700 rounded z-50 text-white p-4 w-60 hidden">
            <label class="flex items-center mb-2 rounded px-4 py-2 hover:bg-gray-600">
              All
              <input type="radio" name="ai-type" value="show_all" class=" ml-auto" <?php echo (!isset($_GET["ai-type"]) || $_GET["ai-type"] == "show_all" ? "checked" : ""); ?>>
            </label>
            <label class="flex items-center mb-2 rounded px-4 py-2 hover:bg-gray-600">
              Exclude AI-generated
              <input type="radio" name="ai-type" value="exclude_ai" class=" ml-auto" <?php echo (isset($_GET["ai-type"]) && $_GET["ai-type"] == "exclude_ai" ? "checked" : ""); ?>>
            </label>
            <label class="flex items-center rounded px-4 py-2 hover:bg-gray-600">
              Only AI-generated
              <input type="radio" name="ai-type" value="only_ai" class=" ml-auto" <?php echo (isset($_GET["ai-type"]) && $_GET["ai-type"] == "only_ai" ? "checked" : ""); ?>>
            </label>
          </div>
        </div>

        <!-- Orientation filter -->
        <div class="relative inline-block">
          <!-- Orientation button -->
          <button id="orientation-btn"
            class="filter-toggle flex items-center bg-gray-700 px-3 py-2 gap-2 rounded-lg text-sm text-white hover:bg-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
            </svg>
            Orientation
            <svg id="orientation-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke-width="1.5" stroke="currentColor"
              class="filter-chevron h-4 w-4 ml-1 transition-transform duration-200">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </button>

          <!-- Orientation popup -->
          <div id="orientation-popup"
            class="absolute top-full left-0 mt-2 bg-gray-900 border border-gray-700 rounded z-50 text-white p-4 w-40 hidden">
            <label class="flex items-center mb-2 rounded px-4 py-2 hover:bg-gray-600 cursor-pointer">
              All
              <input type="radio" name="orientation" value="all" class="ml-auto" checked>
            </label>
            <label class="flex items-center mb-2 rounded px-4 py-2 hover:bg-gray-600 cursor-pointer">
              Horizontal
              <input type="radio" name="orientation" value="horizontal" class="ml-auto">
            </label>
            <label class="flex items-center mb-2 rounded px-4 py-2 hover:bg-gray-600 cursor-pointer">
              Vertical
              <input type="radio" name="orientation" value="vertical" class="ml-auto">
            </label>
            <label class="flex items-center mb-2 rounded px-4 py-2 hover:bg-gray-600 cursor-pointer">
              Square
              <input type="radio" name="orientation" value="square" class="ml-auto">
            </label>
            <label class="flex items-center rounded px-4 py-2 hover:bg-gray-600 cursor-pointer">
              Panoramic
              <input type="radio" name="orientation" value="panoramic" class="ml-auto">
            </label>
          </div>
        </div>

        <!-- Color filter -->
        <div class="relative inline-block">
          <!-- Color button -->
          <button id="color-btn"
            class="filter-toggle flex items-center bg-gray-700 px-3 py-2 gap-2 rounded-lg text-sm text-white hover:bg-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" />
            </svg>
            Color
            <svg id="color-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke-width="1.5" stroke="currentColor" class="filter-chevron h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </button>

          <!-- Color popup -->
          <div id="color-popup"
            class="absolute top-full left-0 mt-2 bg-gray-900 border border-gray-700 rounded z-50 p-4 w-56 hidden">
            <button data-color="all" class="w-full mb-2 px-4 py-2 text-white text-sm bg-gray-800 border border-gray-600 rounded hover:bg-gray-600">All Colors</button>
            <div class="grid grid-cols-6 gap-2">
              <button data-color="red" class="w-7 h-7 rounded-full bg-red-500 border-2 border-gray-700 hover:border-white"></button>
              <button data-color="orange" class="w-7 h-7 rounded-full bg-orange-400 border-2 border-gray-700 hover:border-white"></button>
              <button data-color="yellow" class="w-7 h-7 rounded-full bg-yellow-400 border-2 border-gray-700 hover:border-white"></button>
              <button data-color="green" class="w-7 h-7 rounded-full bg-green-500 border-2 border-gray-700 hover:border-white"></button>
              <button data-color="blue" class="w-7 h-7 rounded-full bg-blue-500 border-2 border-gray-700 hover:border-white"></button>
              <button data-color="purple" class="w-7 h-7 rounded-full bg-purple-500 border-2 border-gray-700 hover:border-white"></button>
              <button data-color="pink" class="w-7 h-7 rounded-full bg-pink-500 border-2 border-gray-700 hover:border-white"></button>
              <button data-color="gray" class="w-7 h-7 rounded-full bg-gray-300 border-2 border-gray-700 hover:border-white"></button>
              <button data-color="black" class="w-7 h-7 rounded-full bg-black border-2 border-gray-700 hover:border-white"></button>
              <button data-color="white" class="w-7 h-7 rounded-full bg-white border-2 border-gray-700 hover:border-blue-500"></button>
              <button data-color="teal" class="w-7 h-7 rounded-full bg-teal-400 border-2 border-gray-700 hover:border-white"></button>
              <button data-color="lime" class="w-7 h-7 rounded-full bg-lime-400 border-2 border-gray-700 hover:border-white"></button>
            </div>
          </div>
        </div>

        <!-- Number of people filter -->
        <div class="relative inline-block">
          <!-- Number of people button -->
          <button id="people-btn"
            class="filter-toggle flex items-center bg-gray-700 px-3 py-2 gap-2 rounded-lg text-sm text-white hover:bg-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            People
            <svg id="people-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke-width="1.5" stroke="currentColor"
              class="filter-chevron h-4 w-4 ml-1 transition-transform duration-200">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </button>

          <!-- people-popup -->
          <div id="people-popup"
            class="absolute top-full left-0 mt-2 bg-gray-900 border border-gray-700 rounded z-50 text-white p-4 w-64 hidden">
            <div class="flex flex-col gap-2">
              <button data-people="all"
                class="bg-gray-800 rounded px-4 py-2 hover:bg-gray-600 w-full text-center border border-gray-600">All</button>
              <button data-people="No,0"
                class="bg-gray-800 rounded px-4 py-2 hover:bg-gray-600 w-full text-center border border-gray-600">No
                people</button>
              <div class="flex bg-gray-800 rounded">
                <button data-people="1"
                  class="people-count-btn flex-1 hover:bg-gray-700 rounded-l-lg px-0 py-2 transition border border-gray-600">1</button>
                <button data-people="2"
                  class="people-count-btn flex-1 hover:bg-gray-700 px-0 py-2 transition border border-gray-600">2</button>
                <button data-people="3"
                  class="people-count-btn flex-1 hover:bg-gray-700 px-0 py-2 transition border border-gray-600">3</button>
                <button data-people="4+"
                  class="people-count-btn flex-1 hover:bg-gray-700 rounded-r-lg px-0 py-2 transition border border-gray-600">4+</button>
              </div>
            </div>
          </div>
        </div>

        <!-- File type filter -->
        <div class="relative inline-block">
          <!-- File type button -->
          <button id="filetype-btn"
            class="filter-toggle flex items-center bg-gray-700 px-3 py-2 gap-2 rounded-lg text-sm text-white hover:bg-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
            File type
            <svg id="filetype-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke-width="1.5" stroke="currentColor"
              class="filter-chevron h-4 w-4 ml-1 transition-transform duration-200">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </button>

          <!-- File type popup -->
          <div id="filetype-popup"
            class="absolute top-full left-0 mt-2 bg-gray-900 border border-gray-700 rounded z-50 text-white p-4 w-40 hidden">
            <label class="flex items-center mb-2 rounded px-4 py-2 hover:bg-gray-600 cursor-pointer">
              All
              <input type="radio" name="filetype" value="all" class="ml-auto" <?php echo (!isset($_GET["filetype"]) || $_GET["filetype"] == "all" ? "checked" : ""); ?>>
            </label>
            <label class="flex items-center mb-2 rounded px-4 py-2 hover:bg-gray-600 cursor-pointer">
              PNG
              <input type="radio" name="filetype" value="1" class="ml-auto" <?php echo (isset($_GET["filetype"]) && $_GET["filetype"] == "1" ? "checked" : ""); ?>>
            </label>
            <label class="flex items-center rounded px-4 py-2 hover:bg-gray-600 cursor-pointer">
              JPG
              <input type="radio" name="filetype" value="2" class="ml-auto" <?php echo (isset($_GET["filetype"]) && $_GET["filetype"] == "2" ? "checked" : ""); ?>>
            </label>
          </div>
        </div>

        <!-- Clear All Filters button -->
        <button id="clear-desktop-filters"
          class="flex items-center bg-red-600 px-3 py-2 gap-2 rounded-lg text-sm text-white hover:bg-red-700 transition hidden">
          Clear All
        </button>
      </div>

    </div>

  </header>
