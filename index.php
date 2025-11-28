<?php

ob_start();

include 'db.php';

// Get parameters and execute search logic
include 'search_logic.php';

$page_title = 'Pixahunt - Free Stock Photos';
if ($raw_q && $raw_q !== 'wallpaper') {
  $page_title = ucwords($q) . ' Images - Free Stock Photos | Pixahunt';
}
if ($page > 1) {
  $page_title .= " - Page $page";
}


echo '<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>' . $page_title . '</title>

  <!-- Tailwind CDN (Restored for stability) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- all links -->
  <link rel="stylesheet" href="style.css">

  <script>
    (function() {
      try {
        // Sidebar logic - only apply on desktop
        var isCollapsed = localStorage.getItem(\'sidebarCollapsed\') === \'true\';
        var isDesktop = window.innerWidth >= 1280;

        if (isCollapsed && isDesktop) {
          var style = document.createElement(\'style\');
          style.id = \'sidebar-fouc-style\';
          style.innerHTML = `
            #logo-sidebar { width: 4rem !important; }
            .ml-64 { margin-left: 4rem !important; }
            .sidebar-text, #sidebar-logo-img, .sidebar-signin { display: none !important; }
            .sidebar-logo { justify-content: center !important; }
            #logo-sidebar .sidebar-menu a { padding: 0.25rem !important; justify-content: center !important; }
            #logo-sidebar .sidebar-menu svg { margin: 0.25rem !important; }
            .sidebar-divider { margin-left: 0.5rem !important; margin-right: 0.5rem !important; }

            /* Use child combinators to avoid affecting popups inside */
            .sidebar-helper-icons > .flex { flex-direction: column !important; gap: 0.5rem !important; align-items: center !important; justify-content: center !important; }
            .sidebar-helper-icons > .flex > div { flex-direction: column !important; gap: 0.5rem !important; }

            /* Hide the footer icons (Help, Message, Theme) in collapsed mode */
            .sidebar-footer-icons { display: none !important; }

            #sidebar-collapse-btn svg { transform: rotate(-90deg) !important; }

            /* Show header logo in collapsed mode */
            header img { display: block !important; }
          `;
          document.head.appendChild(style);
        } else if (!isDesktop) {
          // On mobile, always show header logo (sidebar is hidden)
          var mobileLogo = document.createElement(\'style\');
          mobileLogo.id = \'mobile-logo-style\';
          mobileLogo.innerHTML = `
            header img { display: block !important; }
          `;
          document.head.appendChild(mobileLogo);
        }

        // Filter bar logic
        var isFilterOpen = localStorage.getItem(\'filterDropdownOpen\') === \'true\';
        if (!isFilterOpen) {
           var filterStyle = document.createElement(\'style\');
           filterStyle.id = \'filter-fouc-style\';
           filterStyle.innerHTML = `
             #filters-section { display: none !important; }
           `;
           document.head.appendChild(filterStyle);
        } else {
           var filterStyle = document.createElement(\'style\');
           filterStyle.id = \'filter-fouc-style\';
           filterStyle.innerHTML = `
             .chevron { transform: rotate(180deg) !important; transform-origin: center !important; }
           `;
           document.head.appendChild(filterStyle);
        }
      } catch (e) {}
    })();
  </script>
</head>

<body class="">

  <!-- Desktop sidebar overlay -->
  <aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-all duration-300 bg-gray-600 max-sm:hidden"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 bg-gray-900 flex flex-col">

      <!-- Logo and the collapse button -->
      <div class="sidebar-logo flex items-center justify-between mb-6">
        <a href="https://www.pixahunt.com/">
          <img id="sidebar-logo-img" class="w-[130px]" src="assets/logo/freepik-logo.png" alt="freepik-logo">
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

  <div class="ml-64 max-sm:ml-0 bg-gray-800">

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
                <input type="radio" name="ai-type" value="show_all" class=" ml-auto" ' . (!isset($_GET["ai-type"]) || $_GET["ai-type"] == "show_all" ? "checked" : "") . '>
              </label>
              <label class="flex items-center mb-2 rounded px-4 py-2 hover:bg-gray-600">
                Exclude AI-generated
                <input type="radio" name="ai-type" value="exclude_ai" class=" ml-auto" ' . (isset($_GET["ai-type"]) && $_GET["ai-type"] == "exclude_ai" ? "checked" : "") . '>
              </label>
              <label class="flex items-center rounded px-4 py-2 hover:bg-gray-600">
                Only AI-generated
                <input type="radio" name="ai-type" value="only_ai" class=" ml-auto" ' . (isset($_GET["ai-type"]) && $_GET["ai-type"] == "only_ai" ? "checked" : "") . '>
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
                <input type="radio" name="filetype" value="all" class="ml-auto" ' . (!isset($_GET["filetype"]) || $_GET["filetype"] == "all" ? "checked" : "") . '>
              </label>
              <label class="flex items-center mb-2 rounded px-4 py-2 hover:bg-gray-600 cursor-pointer">
                PNG
                <input type="radio" name="filetype" value="1" class="ml-auto" ' . (isset($_GET["filetype"]) && $_GET["filetype"] == "1" ? "checked" : "") . '>
              </label>
              <label class="flex items-center rounded px-4 py-2 hover:bg-gray-600 cursor-pointer">
                JPG
                <input type="radio" name="filetype" value="2" class="ml-auto" ' . (isset($_GET["filetype"]) && $_GET["filetype"] == "2" ? "checked" : "") . '>
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

    <!-- Main Content -->
    <div id="main-content" class="main-content py-6 px-10">

      <!-- Search results -->
      <div class="tag flex gap-2 text-white px-2 text-sm">
        <h1 class="font-bold">Total</h1>
        <p>' . $total . ' results</p>
      </div><div id="image-gallery" class="columns-1 sm:columns-2 md:columns-3 gap-4 my-5">';

// Performance: Use results from search_logic.php
// $slis is already populated by search_logic.php
if (!$slis) {
  die("Error fetching posts: " . mysqli_error($dbcon));
}

if (mysqli_num_rows($slis) > 0) {
  while ($list = mysqli_fetch_assoc($slis)) {
    echo '<div class="image-card relative group mb-4" data-image="' . $list['id'] . '">
          <img src="https://cdn.pixahunt.com/' . htmlspecialchars($list['view_thumb_img']) . '" class="rounded-lg w-full" alt="' . htmlspecialchars($list['title']) . '" loading="lazy">
        </div>';
  }
  echo '</div>';
} else {
  echo '<div class="alert alert-warning center w-full text-center text-white py-20 text-lg" style="column-span: all;">No results found. Try adjusting your filters or search terms.</div>';
}
echo '

      <!-- Suggested search tags -->
      <div class="relative">
        <!-- Left Arrow -->
        <button id="tags-scroll-left"
          class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-gray-900 bg-opacity-80 hover:bg-opacity-100 text-white p-2 rounded-full transition hidden">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
          </svg>
        </button>

        <!-- Tags Container -->
        <div id="tags-container" class="overflow-x-auto whitespace-nowrap scrollbar-hide scroll-smooth">
          <ul class="flex gap-3 text-xs text-white my-3">
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Create an AI
              image</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Create an AI
              video</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Heart shape
            </li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Heart beat</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Human Heart
            </li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Cardio</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Ryzen</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Royal Kludge
            </li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Logitech</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Fantech</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Razer</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Gamdias</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Human Heart
            </li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Cardio</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Ryzen</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Human Heart
            </li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Cardio</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Ryzen</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Royal Kludge
            </li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Logitech</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Fantech</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Razer</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Gamdias</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Human Heart
            </li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Cardio</li>
            <li class="border px-2 py-2 rounded-full border-gray-600 hover:border-gray-500 inline-block">Ryzen</li>
          </ul>
        </div>

        <!-- Right Arrow -->
        <button id="tags-scroll-right"
          class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-gray-900 bg-opacity-80 hover:bg-opacity-100 text-white p-2 rounded-full transition">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
          </svg>
        </button>
      </div>

      <!-- Pagination controls - Desktop -->
      <div class="pagination-controls hidden sm:flex items-center justify-between mt-10 px-6">
        <!-- Previous page button-->
        <div class="flex-1 flex justify-center">
          <button id="prev-page-btn"
            class="flex items-center px-4 py-2 rounded gap-2 transition ' . ($page <= 1 ? 'bg-gray-600 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-800 hover:bg-gray-100') . '"
            ' . ($page <= 1 ? 'disabled' : '') . '>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
            Previous Page
          </button>
        </div>

        <!-- Page input control-->
        <p class="text-sm text-white flex items-center gap-2">
          Page
          <input type="text" class="rounded bg-gray-600 w-12 px-2 py-1 text-center" value="' . $page . '">
          of ' . $totalPages . '
        </p>

        <!-- Next page button-->
        <div class="flex-1 flex justify-center">
          <button id="next-page-btn"
            class="flex items-center px-4 py-2 rounded gap-2 transition ' . ($page >= $totalPages ? 'bg-gray-600 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-800 hover:bg-gray-100') . '"
            ' . ($page >= $totalPages ? 'disabled' : '') . '>
            Next Page
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Pagination controls - Mobile -->
      <div class="mobile-pagination-controls sm:hidden flex flex-col items-center gap-4 mt-10 px-4">
        <!-- Page indicator -->
        <p class="text-sm text-white flex items-center gap-2">
          Page
          <input type="text" id="mobile-page-input" class="rounded bg-gray-600 w-12 px-2 py-1 text-center" value="' . $page . '">
          of <span id="mobile-total-pages">' . $totalPages . '</span>
        </p>

        <!-- Navigation buttons -->
        <div class="flex gap-3 w-full">
          <button id="mobile-prev-page-btn"
            class="flex-1 flex items-center justify-center px-4 py-3 rounded gap-2 transition text-sm ' . ($page <= 1 ? 'bg-gray-600 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-800 hover:bg-gray-100') . '"
            ' . ($page <= 1 ? 'disabled' : '') . '>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
            Previous
          </button>
          <button id="mobile-next-page-btn"
            class="flex-1 flex items-center justify-center px-4 py-3 rounded gap-2 transition text-sm ' . ($page >= $totalPages ? 'bg-gray-600 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-800 hover:bg-gray-100') . '"
            ' . ($page >= $totalPages ? 'disabled' : '') . '>
            Next
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Content separator -->
      <hr class="border-t border-gray-500 my-10 max-sm:hidden">
    </div>

    <!-- Footer section -->
    <footer class="bg-gray-800 text-white px-6 lg:px-20 py-10 text-sm">

      <!-- Freepik logo -->
      <div class="mb-8 text-center lg:text-left">
        <a href="https://www.pixahunt.com/"><img class="w-[130px] mx-auto lg:mx-0" src="assets/logo/freepik-logo.png" alt="freepik-logo"></a>
      </div>

      <!-- Desktop: 4-column grid -->
      <div class="hidden lg:grid lg:grid-cols-4 gap-10">

        <!-- Products column -->
        <ul class="space-y-2">
          <li class="font-semibold select-none text-gray-500">Products</li>
          <li>AI Assistant</li>
          <li>AI Image Generator</li>
          <li>AI Video Generator</li>
          <li>AI Voice Generator</li>
          <li>API</li>
          <li>Android</li>
          <li>iOS</li>
          <li>All Freepik tools</li>
        </ul>

        <!-- Get started column -->
        <ul class="space-y-2">
          <li class="font-semibold select-none text-gray-500">Get started</li>
          <li>Pricing</li>
          <li>Sell content</li>
          <li>Enterprise</li>
          <li>FAQ</li>
          <li>AI Suite documentation</li>
          <li>Terms of use</li>
          <li>Privacy policy</li>
          <li>Cookies policy</li>
          <li>Cookies settings</li>
        </ul>

        <!-- Company column -->
        <ul class="space-y-2">
          <li class="font-semibold select-none text-gray-500">Company</li>
          <li>About us</li>
          <li>Careers</li>
          <li>Search trends</li>
          <li>Blog</li>
          <li>Events</li>
          <li>Magnific</li>
          <li>Slidesgo</li>
          <li>Help center</li>
        </ul>

        <!-- Contact and social media column -->
        <ul class="space-y-4 w-[250px] text-sm">
          <li class="font-semibold select-none text-gray-500">Get in touch</li>
          <!-- Social media icons grid -->
          <li class="mt-5">
            <div class="grid grid-cols-4 gap-3">
              <!-- Facebook -->
              <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.3l-.4 3h-1.9v7A10 10 0 0 0 22 12z" />
              </svg>
              <!-- Twitter/X -->
              <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19.6 5.3 13.2 12l6.9 6.7h-2.2l-6-5.8-6 5.8H3.7l7.1-7-6.6-6.4h2.2l5.7 5.5 5.7-5.5h2.2z" />
              </svg>
              <!-- Instagram -->
              <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10zm-5 3.5A4.5 4.5 0 1 0 16.5 12 4.5 4.5 0 0 0 12 7.5zm0 7.5a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm4.8-7.8a1 1 0 1 1-1-1 1 1 0 0 1 1 1z" />
              </svg>
              <!-- YouTube -->
              <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M10 15.5v-7l6 3.5-6 3.5zM21.8 8s-.2-1.4-.8-2c-.8-.8-1.7-.8-2.2-.9C16.2 5 12 5 12 5s-4.2 0-6.8.1c-.5 0-1.4.1-2.2.9-.6.6-.8 2-.8 2S2 9.6 2 11.2v1.6c0 1.6.2 3.2.2 3.2s.2 1.4.8 2c.8.8 1.9.8 2.4.9 1.8.2 7.4.2 7.4.2s4.2 0 6.8-.1c.5 0 1.4-.1 2.2-.9.6-.6.8-2 .8-2s.2-1.6.2-3.2v-1.6c0-1.6-.2-3.2-.2-3.2z" />
              </svg>
              <!-- LinkedIn -->
              <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 8.98h4v12H3v-12zm7.5 0h3.6v1.6h.1c.5-.9 1.7-1.8 3.4-1.8 3.6 0 4.3 2.4 4.3 5.4v6.8h-4v-6c0-1.4 0-3.2-2-3.2s-2.3 1.5-2.3 3.1v6.1h-4v-12z" />
              </svg>
              <!-- Pinterest -->
              <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 2a10 10 0 0 0-3.6 19.3c-.1-.8-.2-2 .1-2.9.2-.7 1.3-4.4 1.3-4.4s-.3-.6-.3-1.5c0-1.4.8-2.5 1.8-2.5.8 0 1.2.6 1.2 1.4 0 .9-.6 2.3-.9 3.6-.3 1 .7 1.8 1.6 1.8 2 0 3.5-2.1 3.5-5.1 0-2.7-2-4.6-4.8-4.6-3.3 0-5.2 2.5-5.2 5.1 0 1 .4 2.1 1 2.7.1.1.1.2.1.3-.1.3-.3 1-.4 1.2-.1.2-.2.3-.4.2-1.2-.5-2-2.1-2-3.4 0-2.8 2-5.4 5.8-5.4 3.1 0 5.5 2.2 5.5 5.2 0 3.1-2 5.6-4.8 5.6-1 0-1.9-.5-2.2-1.1l-.6 2.3c-.2.9-.7 2-1 2.7A10 10 0 1 0 12 2z" />
              </svg>
              <!-- TikTok -->
              <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M16.5 3.5c1.1 1.1 2.4 1.8 4 1.9v3.1c-1.6-.1-3.1-.7-4.4-1.6v6.9c0 3.1-2.5 5.6-5.6 5.6S5.9 16.9 5.9 13.8s2.5-5.6 5.6-5.6c.4 0 .8 0 1.2.1v3.1c-.4-.1-.8-.2-1.2-.2-1.4 0-2.5 1.1-2.5 2.5s1.1 2.5 2.5 2.5 2.5-1.1 2.5-2.5V2h3.5v1.5z" />
              </svg>
              <!-- Behance -->
              <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 2c-3.6 0-6.5 2.9-6.5 6.5 0 2.3 1.2 4.3 3.1 5.5-.3.4-.7.8-1.2 1.1-.6.4-1.3.6-2 .7-.4.1-.7.5-.6.9.1.4.5.7.9.8 1.2.2 2.2.6 2.9 1.2.3.3.6.7.9 1 .6.6 1.3 1.1 2.1 1.1s1.5-.5 2.1-1.1c.3-.3.6-.7.9-1 .7-.6 1.7-1 2.9-1.2.4-.1.8-.4.9-.8.1-.4-.2-.8-.6-.9-.7-.1-1.4-.3-2-.7-.5-.3-.9-.7-1.2-1.1 1.9-1.2 3.1-3.2 3.1-5.5C18.5 4.9 15.6 2 12 2z" />
              </svg>
            </div>
          </div>
        </div>

        <!-- Language selector for mobile -->
        <div class="text-center bg-gray-800">
          <select class="bg-gray-800 border border-gray-600 rounded px-5 py-2 text-white text-sm mb-2">
            <option>English</option>
            <option>বাংলা</option>
            <option>Español</option>
            <option>Français</option>
          </select>
        </div>

        <!-- Copyright -->
        <div class="text-center text-gray-500 text-xs bg-gray-800 pb-2">
          Copyright © 2010–2025 Freepik Company S.L. All rights reserved.
        </div>

      </div>
    </footer>

  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>';

$scriptFile = file_exists('script.min.js') ? 'script.min.js' : 'script.js';
$scriptVersion = file_exists($scriptFile) ? filemtime($scriptFile) : time();

echo '<script src="' . $scriptFile . '?v=' . $scriptVersion . '"></script>
</body>

</html>';
