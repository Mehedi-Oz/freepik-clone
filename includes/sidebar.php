<!-- Desktop sidebar overlay -->
<aside id="logo-sidebar"
  class="fixed top-0 left-0 z-40 w-64 h-screen transition-all duration-300 bg-gray-600 max-sm:hidden"
  aria-label="Sidebar">
  <div class="h-full px-3 py-4 bg-gray-900 flex flex-col">

    <!-- Logo and the collapse button -->
    <div class="sidebar-logo flex items-center justify-between mb-6">
      <a href="https://www.pixahunt.com/">
        <img id="sidebar-logo-img" class="w-[130px]" src="<?php echo BASE_PATH; ?>/assets/logo/freepik-logo.png" alt="freepik-logo">
      </a>
      <div id="sidebar-collapse-btn"
        class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor" class="h-4 w-4 rotate-90 text-gray-600 dark:text-gray-300">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6ZM7.5 6h.008v.008H7.5V6Zm2.25 0h.008v.008H9.75V6Z" />
        </svg>
      </div>
    </div>

    <!-- Sidebar first menu -->
    <ul class="space-y-2 font-medium text-sm sidebar-menu">
      <li>
        <a href="javascript:void(0)"
          class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M2.25 12l9.75-9.75L21.75 12M4.5 9.75V21h15V9.75" />
          </svg>
          <span class="ms-3 sidebar-text">Home</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0)"
          class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 7.5l-9-4.5-9 4.5m18 0l-9 4.5m9-4.5v9l-9 4.5m-9-13.5v9l9 4.5" />
          </svg>
          <span class="ms-3 sidebar-text">AI Suite</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0)"
          class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 7.5l9-4.5 9 4.5M3 7.5v9l9 4.5m9-13.5v9l-9 4.5" />
          </svg>
          <span class="ms-3 sidebar-text">Stock</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0)"
          class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15 19.125a3.375 3.375 0 11-6.75 0m6.75 0a3.375 3.375 0 01-6.75 0m6.75 0H21m-6 0H3m18 0a9 9 0 10-18 0" />
          </svg>
          <span class="ms-3 sidebar-text">Community</span>
        </a>
      </li>
    </ul>

    <hr class="border-t border-gray-500 mx mt-4 mb-4 sidebar-divider">

    <!-- Sidebar second menu -->
    <ul class="space-y-2 font-medium text-sm sidebar-menu">
      <li>
        <a href="javascript:void(0)"
          class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5.25h18v13.5H3V5.25zM3 5.25l9 9 9-9" />
          </svg>
          <span class="ms-3 sidebar-text">Image Generator</span>
        </a>
      </li>
      <li>
        <a href="javascript:void(0)"
          class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 10.5V6.75A2.25 2.25 0 0013.5 4.5h-9A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 19.5h9a2.25 2.25 0 002.25-2.25V13.5l6 3.75v-9l-6 3.75z" />
          </svg>
          <span class="ms-3 sidebar-text">Video Generator</span>
        </a>
      </li>

      <li>
        <a href="javascript:void(0)"
          class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 10.5V6.75A2.25 2.25 0 0013.5 4.5h-9A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 19.5h9a2.25 2.25 0 002.25-2.25V13.5l6 3.75v-9l-6 3.75z" />
          </svg>
          <span class="ms-3 sidebar-text">Assist</span>
        </a>
      </li>

      <li class="relative">
        <a href="javascript:void(0)" id="all-tools-btn"
          class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 3v2.25M12 18.75V21m9-9h-2.25M3 12H.75m16.364-6.364l-1.591 1.591M6.227 17.773l-1.591 1.591m0-13.182l1.591 1.591M17.773 17.773l1.591 1.591" />
          </svg>
          <span class="ms-3 sidebar-text">All Tools</span>
        </a>

        <!-- All Tools popup -->
        <div id="all-tools-popup"
          class="hidden absolute top-0 left-full ml-4 bg-gray-800 border border-gray-600 rounded shadow-lg z-50 text-white text-sm whitespace-nowrap">

          <div class="px-4 pt-4 pb-2">
            <h2 class="text-white font-bold text-lg">All Tools</h2>
          </div>

          <div class="flex">

            <!-- Image Section -->
            <div class="py-3 px-4">
              <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Image</div>
              <hr class="border-gray-600 mb-2">
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Image
                Generator</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Image
                Editor</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Image
                Upscaler</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded flex items-center gap-2">
                Assistant
                <span class="bg-green-600 text-white text-xs px-2 py-0.5 rounded">New</span>
              </a>
            </div>

            <!-- Video Section -->
            <div class="py-3 px-4">
              <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Video</div>
              <hr class="border-gray-600 mb-2">
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Video
                Generator</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Video
                Project Editor</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Clip
                Editor</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Lip
                Sync</a>
            </div>

            <!-- Audio Section -->
            <div class="py-3 px-4">
              <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Audio</div>
              <hr class="border-gray-600 mb-2">
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Voice
                Generator</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Sound
                Effect Generator</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Music
                Generator</a>
            </div>

            <!-- Others Section -->
            <div class="py-3 px-4">
              <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Others</div>
              <hr class="border-gray-600 mb-2">
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Designer</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Mockup
                Generator</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Icon
                Generator</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Background
                Remover</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Image
                Extender</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Reimagine</a>
              <a href="javascript:void(0)"
                class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Sketch
                to Image</a>
            </div>
          </div>

          <div class="border-t border-gray-600">
            <div class="flex gap-6 px-6 py-3">
              <a href="javascript:void(0)" class="flex items-center gap-2 text-gray-400 hover:text-white transition">
                Spaces
              </a>
              <a href="javascript:void(0)"
                class="flex items-center gap-2 text-gray-400 hover:text-white transition ml-auto">
                AI News
              </a>
            </div>
          </div>
        </div>
      </li>
    </ul>

    <!-- Sign-in prompt -->
    <div class="absolute bottom-20 left-0 w-full px-4 sidebar-signin">
      <div class="bg-gray-700 rounded-lg p-4 text-sm text-white space-y-2 shadow-md">
        <div class="flex items-center justify-between">
          <span class="text-orange-400 font-semibold sidebar-text">Sign in</span>
        </div>
        <p class="text-gray-300 sidebar-text">Get started for free</p>
      </div>
    </div>

    <!-- Sidebar footer -->
    <div class="absolute bottom-0 left-0 w-full px-4 pb-5 sidebar-helper-icons">
      <div class="flex justify-between items-center gap-4 text-white">
        <div class="flex gap-4 sidebar-footer-icons">

          <!-- Help icon -->
          <div class="p-2 rounded hover:bg-gray-600 transition cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
            </svg>
          </div>

          <!-- Message icon -->
          <div class="p-2 rounded hover:bg-gray-600 transition cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
          </div>

          <!-- Theme switcher icon -->
          <details class="relative">
            <summary class="p-2 rounded hover:bg-gray-600 transition cursor-pointer list-none">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
              </svg>
            </summary>
            <div
              class="absolute bottom-full mb-2 w-30 bg-gray-800 border border-gray-600 rounded shadow-lg z-50 text-white text-sm">
              <ul class="py-1">
                <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                  </svg>
                  Light
                </li>
                <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                  </svg>
                  Dark
                </li>
                <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                  </svg>
                  System
                </li>
              </ul>
            </div>
          </details>
        </div>

        <!-- More options icon-->
        <div class="relative">
          <div id="more-options-btn" class="p-2 rounded hover:bg-gray-600 transition cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4 rotate-90 origin-center">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
          </div>

          <!-- More options popup -->
          <div id="more-options-popup"
            class="hidden absolute bottom-0 left-full ml-5 bg-gray-800 border border-gray-600 rounded shadow-lg z-50 text-white text-sm whitespace-nowrap">

            <div class="flex flex-col">
              <!-- Top section with columns -->
              <div class="flex">
                <!-- Company Section -->
                <div class="py-3 px-4">
                  <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Company</div>
                  <hr class="border-gray-600 mb-2">
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Pricing</a>
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">About
                    us</a>
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">AI
                    Partners Program</a>
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Events</a>
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Blog</a>
                </div>

                <!-- Enterprise Section -->
                <div class="py-3 px-4">
                  <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Enterprise</div>
                  <hr class="border-gray-600 mb-2">
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">API
                    for Developers</a>
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">AI
                    Suite documentation</a>
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Android</a>
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">iOS</a>
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Sell
                    content</a>
                </div>

                <!-- Legal Section -->
                <div class="py-3 px-4">
                  <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Legal</div>
                  <hr class="border-gray-600 mb-2">
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Terms
                    of use</a>
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Privacy
                    policy</a>
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Cookies
                    policy</a>
                  <a href="javascript:void(0)"
                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Cookie
                    settings</a>
                </div>
              </div>

              <!-- Bottom section with icons (shown when collapsed) -->
              <div id="collapsed-footer-icons" class="hidden border-t border-gray-600 py-3 px-4">
                <div class="flex gap-4 justify-start">
                  <!-- Help icon -->
                  <div class="p-2 rounded hover:bg-gray-700 transition cursor-pointer" title="Help">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="h-4 w-4">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                    </svg>
                  </div>

                  <!-- Message icon -->
                  <div class="p-2 rounded hover:bg-gray-700 transition cursor-pointer" title="Messages">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="h-4 w-4">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                  </div>

                  <!-- Theme switcher icon -->
                  <details class="relative">
                    <summary class="p-2 rounded hover:bg-gray-600 transition cursor-pointer list-none">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                      </svg>
                    </summary>
                    <div
                      class="absolute bottom-full mb-2 w-30 bg-gray-800 border border-gray-600 rounded shadow-lg z-50 text-white text-sm">
                      <ul class="py-1">
                        <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                          </svg>
                          Light
                        </li>
                        <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                          </svg>
                          Dark
                        </li>
                        <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                          </svg>
                          System
                        </li>
                      </ul>
                    </div>
                  </details>
                </div>

                <!-- More options icon-->
                <div class="relative">
                  <div id="more-options-btn" class="p-2 rounded hover:bg-gray-600 transition cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="h-4 w-4 rotate-90 origin-center">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                  </div>

                  <!-- More options popup -->
                  <div id="more-options-popup"
                    class="hidden absolute bottom-0 left-full ml-5 bg-gray-800 border border-gray-600 rounded shadow-lg z-50 text-white text-sm whitespace-nowrap">

                    <div class="flex flex-col">
                      <!-- Top section with columns -->
                      <div class="flex">
                        <!-- Company Section -->
                        <div class="py-3 px-4">
                          <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Company</div>
                          <hr class="border-gray-600 mb-2">
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Pricing</a>
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">About
                            us</a>
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">AI
                            Partners Program</a>
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Events</a>
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Blog</a>
                        </div>

                        <!-- Enterprise Section -->
                        <div class="py-3 px-4">
                          <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Enterprise</div>
                          <hr class="border-gray-600 mb-2">
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">API
                            for Developers</a>
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">AI
                            Suite documentation</a>
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Android</a>
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">iOS</a>
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Sell
                            content</a>
                        </div>

                        <!-- Legal Section -->
                        <div class="py-3 px-4">
                          <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Legal</div>
                          <hr class="border-gray-600 mb-2">
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Terms
                            of use</a>
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Privacy
                            policy</a>
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Cookies
                            policy</a>
                          <a href="javascript:void(0)"
                            class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Cookie
                            settings</a>
                        </div>
                      </div>

                      <!-- Bottom section with icons (shown when collapsed) -->
                      <div id="collapsed-footer-icons" class="hidden border-t border-gray-600 py-3 px-4">
                        <div class="flex gap-4 justify-start">
                          <!-- Help icon -->
                          <div class="p-2 rounded hover:bg-gray-700 transition cursor-pointer" title="Help">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                              stroke="currentColor" class="h-4 w-4">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                          </div>

                          <!-- Message icon -->
                          <div class="p-2 rounded hover:bg-gray-700 transition cursor-pointer" title="Messages">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                              stroke="currentColor" class="h-4 w-4">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                          </div>

                          <!-- Theme switcher icon -->
                          <details class="relative">
                            <summary class="p-2 rounded hover:bg-gray-600 transition cursor-pointer list-none">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                              </svg>
                            </summary>
                            <div
                              class="absolute bottom-full mb-2 w-30 bg-gray-800 border border-gray-600 rounded shadow-lg z-50 text-white text-sm">
                              <ul class="py-1">
                                <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                  </svg>
                                  Light
                                </li>
                                <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                  </svg>
                                  Dark
                                </li>
                                <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                                  </svg>
                                  System
                                </li>
                              </ul>
                            </div>
                          </details>
                        </div>

                        <!-- More options icon-->
                        <div class="relative">
                          <div id="more-options-btn" class="p-2 rounded hover:bg-gray-600 transition cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                              stroke="currentColor" class="h-4 w-4 rotate-90 origin-center">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                          </div>

                          <!-- More options popup -->
                          <div id="more-options-popup"
                            class="hidden absolute bottom-0 left-full ml-5 bg-gray-800 border border-gray-600 rounded shadow-lg z-50 text-white text-sm whitespace-nowrap">

                            <div class="flex flex-col">
                              <!-- Top section with columns -->
                              <div class="flex">
                                <!-- Company Section -->
                                <div class="py-3 px-4">
                                  <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Company</div>
                                  <hr class="border-gray-600 mb-2">
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Pricing</a>
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">About
                                    us</a>
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">AI
                                    Partners Program</a>
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Events</a>
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Blog</a>
                                </div>

                                <!-- Enterprise Section -->
                                <div class="py-3 px-4">
                                  <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Enterprise</div>
                                  <hr class="border-gray-600 mb-2">
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">API
                                    for Developers</a>
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">AI
                                    Suite documentation</a>
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Android</a>
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">iOS</a>
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Sell
                                    content</a>
                                </div>

                                <!-- Legal Section -->
                                <div class="py-3 px-4">
                                  <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Legal</div>
                                  <hr class="border-gray-600 mb-2">
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Terms
                                    of use</a>
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Privacy
                                    policy</a>
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Cookies
                                    policy</a>
                                  <a href="javascript:void(0)"
                                    class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Cookie
                                    settings</a>
                                </div>
                              </div>

                              <!-- Bottom section with icons (shown when collapsed) -->
                              <div id="collapsed-footer-icons" class="hidden border-t border-gray-600 py-3 px-4">
                                <div class="flex gap-4 justify-start">
                                  <!-- Help icon -->
                                  <div class="p-2 rounded hover:bg-gray-700 transition cursor-pointer" title="Help">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                      stroke="currentColor" class="h-4 w-4">
                                      <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                    </svg>
                                  </div>

                                  <!-- Message icon -->
                                  <div class="p-2 rounded hover:bg-gray-700 transition cursor-pointer" title="Messages">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                      stroke="currentColor" class="h-4 w-4">
                                      <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                  </div>

                                  <!-- Theme switcher icon -->
                                  <div class="p-2 rounded hover:bg-gray-700 transition cursor-pointer" title="Theme">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                      stroke="currentColor" class="h-4 w-4">
                                      <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                    </svg>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
</aside>

<aside id="mobile-sidebar-overlay"
  class="fixed top-0 left-0 z-50 w-full h-screen bg-black bg-opacity-50 hidden sm:hidden">
  <div
    class="fixed top-0 left-0 z-50 w-full h-screen transition-transform duration-300 bg-gray-900 transform -translate-x-full"
    id="mobile-sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-900 flex flex-col">

      <!-- Mobile: logo and the collapse button -->
      <div class="sidebar-logo flex items-center justify-between mb-6 px-2">
        <a href="https://www.pixahunt.com/">
          <img class="w-[130px]" src="assets/logo/freepik-logo.png" alt="freepik-logo">
        </a>
        <button id="mobile-sidebar-close" class="p-2 rounded hover:bg-gray-700 transition cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-5 w-5 text-gray-300">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Mobile: sidebar first menu -->
      <ul class="space-y-2 font-medium text-sm sidebar-menu px-2">
        <li class="w-full">
          <a href="javascript:void(0)"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group w-full justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4 flex-shrink-0">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 12l9.75-9.75L21.75 12M4.5 9.75V21h15V9.75" />
            </svg>
            <span class="ms-3">Home</span>
          </a>
        </li>
        <li class="w-full">
          <a href="javascript:void(0)"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group w-full justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4 flex-shrink-0">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 7.5l-9-4.5-9 4.5m18 0l-9 4.5m9-4.5v9l-9 4.5m-9-13.5v9l9 4.5" />
            </svg>
            <span class="ms-3">AI Suite</span>
          </a>
        </li>
        <li class="w-full">
          <a href="javascript:void(0)"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group w-full justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4 flex-shrink-0">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 7.5l9-4.5 9 4.5M3 7.5v9l9 4.5m9-13.5v9l-9 4.5" />
            </svg>
            <span class="ms-3">Stock</span>
          </a>
        </li>
        <li class="w-full">
          <a href="javascript:void(0)"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group w-full justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4 flex-shrink-0">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 19.125a3.375 3.375 0 11-6.75 0m6.75 0a3.375 3.375 0 01-6.75 0m6.75 0H21m-6 0H3m18 0a9 9 0 10-18 0" />
            </svg>
            <span class="ms-3">Community</span>
          </a>
        </li>
      </ul>

      <hr class="border-t border-gray-500 mt-4 mb-4 mx-2">

      <!-- Mobile: sidebar second menu -->
      <ul class="space-y-2 font-medium text-sm sidebar-menu px-2">
        <li class="w-full">
          <a href="javascript:void(0)"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group w-full justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4 flex-shrink-0">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 5.25h18v13.5H3V5.25zM3 5.25l9 9 9-9" />
            </svg>
            <span class="ms-3">Image Generator</span>
          </a>
        </li>
        <li class="w-full">
          <a href="javascript:void(0)"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group w-full justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4 flex-shrink-0">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 10.5V6.75A2.25 2.25 0 0013.5 4.5h-9A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 19.5h9a2.25 2.25 0 002.25-2.25V13.5l6 3.75v-9l-6 3.75z" />
            </svg>
            <span class="ms-3">Video Generator</span>
          </a>
        </li>
        <li class="w-full">
          <a href="javascript:void(0)"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group w-full justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4 flex-shrink-0">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 10.5V6.75A2.25 2.25 0 0013.5 4.5h-9A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 19.5h9a2.25 2.25 0 002.25-2.25V13.5l6 3.75v-9l-6 3.75z" />
            </svg>
            <span class="ms-3">Assist</span>
          </a>
        </li>
        <li class="w-full">
          <a href="javascript:void(0)"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group w-full justify-start">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4 flex-shrink-0">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 3v2.25M12 18.75V21m9-9h-2.25M3 12H.75m16.364-6.364l-1.591 1.591M6.227 17.773l-1.591 1.591m0-13.182l1.591 1.591M17.773 17.773l1.591 1.591" />
            </svg>
            <span class="ms-3">All Tools</span>
          </a>
        </li>
      </ul>

      <!-- Mobile: sign-in prompt -->
      <div class="absolute bottom-20 left-0 w-full px-4">
        <div class="bg-gray-700 rounded-lg p-4 text-sm text-white space-y-2 shadow-md">
          <div class="flex items-center justify-between">
            <span class="text-orange-400 font-semibold">Sign in</span>
          </div>
          <p class="text-gray-300">Get started for free</p>
        </div>
      </div>

      <!-- Sidebar footer icons -->
      <div class="absolute bottom-0 left-0 w-full px-4 pb-5">
        <div class="flex justify-between items-center gap-4 text-white">
          <div class="flex gap-4">

            <!-- Help icon -->
            <div class="p-2 rounded hover:bg-gray-600 transition cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
              </svg>
            </div>

            <!-- Message icon -->
            <div class="p-2 rounded hover:bg-gray-600 transition cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
              </svg>
            </div>

            <!-- Theme switcher icon -->
            <details class="relative">
              <summary class="p-2 rounded hover:bg-gray-600 transition cursor-pointer list-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                </svg>
              </summary>
              <div
                class="absolute bottom-full mb-2 w-30 bg-gray-800 border border-gray-600 rounded shadow-lg z-50 text-white text-sm">
                <ul class="py-1">
                  <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="h-4 w-4">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                    </svg>
                    Light
                  </li>
                  <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="h-4 w-4">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                    </svg>
                    Dark
                  </li>
                  <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="h-4 w-4">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                    System
                  </li>
                </ul>
              </div>
            </details>
          </div>

          <!-- More options icon-->
          <div class="relative">
            <div id="more-options-btn" class="p-2 rounded hover:bg-gray-600 transition cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-4 w-4 rotate-90 origin-center">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
            </div>

            <!-- More options popup -->
            <div id="more-options-popup"
              class="hidden absolute bottom-0 left-full ml-5 bg-gray-800 border border-gray-600 rounded shadow-lg z-50 text-white text-sm whitespace-nowrap">

              <div class="flex flex-col">
                <!-- Top section with columns -->
                <div class="flex">
                  <!-- Company Section -->
                  <div class="py-3 px-4">
                    <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Company</div>
                    <hr class="border-gray-600 mb-2">
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Pricing</a>
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">About
                      us</a>
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">AI
                      Partners Program</a>
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Events</a>
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Blog</a>
                  </div>

                  <!-- Enterprise Section -->
                  <div class="py-3 px-4">
                    <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Enterprise</div>
                    <hr class="border-gray-600 mb-2">
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">API
                      for Developers</a>
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">AI
                      Suite documentation</a>
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Android</a>
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">iOS</a>
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Sell
                      content</a>
                  </div>

                  <!-- Legal Section -->
                  <div class="py-3 px-4">
                    <div class="px-2 py-2 text-white font-semibold text-sm mb-2">Legal</div>
                    <hr class="border-gray-600 mb-2">
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Terms
                      of use</a>
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Privacy
                      policy</a>
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Cookies
                      policy</a>
                    <a href="javascript:void(0)"
                      class="block px-2 py-1.5 text-gray-400 hover:text-white hover:bg-gray-700 transition rounded">Cookie
                      settings</a>
                  </div>
                </div>

                <!-- Bottom section with icons (shown when collapsed) -->
                <div id="collapsed-footer-icons" class="hidden border-t border-gray-600 py-3 px-4">
                  <div class="flex gap-4 justify-start">
                    <!-- Help icon -->
                    <div class="p-2 rounded hover:bg-gray-700 transition cursor-pointer" title="Help">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                      </svg>
                    </div>

                    <!-- Message icon -->
                    <div class="p-2 rounded hover:bg-gray-700 transition cursor-pointer" title="Messages">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                      </svg>
                    </div>

                    <!-- Theme switcher icon -->
                    <div class="p-2 rounded hover:bg-gray-700 transition cursor-pointer" title="Theme">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
</aside>

<!-- Mobile All Tools Full Page -->
<div id="mobile-all-tools-page" class="hidden fixed inset-0 z-[60] bg-gray-900 overflow-y-auto sm:hidden">
  <div class="min-h-screen">

    <!-- Header with back button -->
    <div class="sticky top-0 bg-gray-900 border-b border-gray-700 px-4 py-4 flex items-center gap-4">
      <button id="mobile-all-tools-back" class="p-2 hover:bg-gray-700 rounded transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
          class="h-6 w-6 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
      </button>
      <h2 class="text-white font-bold text-xl">All Tools</h2>
    </div>

    <!-- Content -->
    <div class="p-4">
      <div class="flex flex-wrap -mx-2">

        <!-- Image Section -->
        <div class="w-1/2 px-2 mb-4">
          <div class=" rounded-lg p-4">
            <div class="text-white font-semibold text-sm mb-3">Image</div>
            <hr class="border-gray-600 mb-3">
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Image
              Generator</a>
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Image
              Editor</a>
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Image
              Upscaler</a>
            <a href="javascript:void(0)"
              class="flex items-center gap-2 py-2 text-gray-400 hover:text-white transition text-sm">
              Assistant
              <span class="bg-green-600 text-white text-xs px-2 py-0.5 rounded">New</span>
            </a>
          </div>
        </div>

        <!-- Video Section -->
        <div class="w-1/2 px-2 mb-4">
          <div class=" rounded-lg p-4">
            <div class="text-white font-semibold text-sm mb-3">Video</div>
            <hr class="border-gray-600 mb-3">
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Video
              Generator</a>
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Video
              Project Editor</a>
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Clip
              Editor</a>
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Lip
              Sync</a>
          </div>
        </div>

        <!-- Audio Section -->
        <div class="w-1/2 px-2 mb-4">
          <div class=" rounded-lg p-4">
            <div class="text-white font-semibold text-sm mb-3">Audio</div>
            <hr class="border-gray-600 mb-3">
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Voice
              Generator</a>
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Sound
              Effect
              Generator</a>
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Music
              Generator</a>
          </div>
        </div>

        <!-- Others Section -->
        <div class="w-1/2 px-2 mb-4">
          <div class=" rounded-lg p-4">
            <div class="text-white font-semibold text-sm mb-3">Others</div>
            <hr class="border-gray-600 mb-3">
            <a href="javascript:void(0)"
              class="block py-2 text-gray-400 hover:text-white transition text-sm">Designer</a>
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Mockup
              Generator</a>
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Icon
              Generator</a>
            <a href="javascript:void(0)"
              class="block py-2 text-gray-400 hover:text-white transition text-sm">Background Remover</a>
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Image
              Extender</a>
            <a href="javascript:void(0)"
              class="block py-2 text-gray-400 hover:text-white transition text-sm">Reimagine</a>
            <a href="javascript:void(0)" class="block py-2 text-gray-400 hover:text-white transition text-sm">Sketch
              to Image</a>
          </div>
        </div>
      </div>

      <!-- Bottom Links -->
      <div class="border-t border-gray-700 mt-6 pt-4">
        <div class="flex justify-between items-center">
          <a href="javascript:void(0)" class="flex items-center gap-2 text-gray-400 hover:text-white transition py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-5 w-5">
              <path
                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            Spaces
          </a>
          <a href="javascript:void(0)" class="flex items-center gap-2 text-gray-400 hover:text-white transition py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-5 w-5">
              <path d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
            </svg>
            AI News
          </a>
        </div>
      </div>

    </div>
  </div>
</div>
