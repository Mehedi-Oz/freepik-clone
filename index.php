<?php

ob_start();

include 'db.php';

// Get parameters and execute search logic
include 'search_logic.php';

$page_title = 'Pixahunt - Free Stock Photos';
if (isset($raw_q) && $raw_q && $raw_q !== 'wallpaper' && isset($q)) {
  $page_title = ucwords($q) . ' Images - Free Stock Photos | Pixahunt';
}
if (isset($page) && $page > 1) {
  $page_title .= " - Page $page";
}

// Include head section
include 'includes/head.php';
?>

<body class="">

  <?php
  // Include sidebar (both desktop and mobile)
  include 'includes/sidebar.php';
  ?>

  <div class="ml-64 max-sm:ml-0 bg-gray-800">

    <?php
    // Include header section
    include 'includes/header.php';
    ?>

    <!-- Main Content -->
    <div id="main-content" class="main-content py-6 px-10">

      <!-- Search results -->
      <div class="tag flex gap-2 text-white px-2 text-sm">
        <h1 class="font-bold">Total</h1>
        <p><?php echo isset($total) ? $total : 0; ?> results</p>
      </div>
      <div id="image-gallery" class="columns-1 sm:columns-2 md:columns-3 gap-4 my-5">
        <?php

        // Performance: Use results from search_logic.php
        // $slis is already populated by search_logic.php
        if (!$slis || !$dbcon) {
          if (ENVIRONMENT === 'development') {
            echo '<div class="alert alert-error center w-full text-center text-white py-20 text-lg col-span-full">Database connection failed. Please check your database configuration in db.php</div>';
          } else {
            echo '<div class="alert alert-error center w-full text-center text-white py-20 text-lg col-span-full">Unable to load images. Please try again later.</div>';
          }
        } elseif (($slis instanceof mysqli_result || $slis instanceof ArrayIterator || is_array($slis)) &&
          (($slis instanceof mysqli_result && mysqli_num_rows($slis) > 0) ||
            ($slis instanceof ArrayIterator && count($slis) > 0) ||
            (is_array($slis) && count($slis) > 0))
        ) {
          // Handle both mysqli_result and array/ArrayIterator (from cache)
          if ($slis instanceof ArrayIterator || is_array($slis)) {
            // Reset iterator if needed
            if ($slis instanceof ArrayIterator) {
              $slis->rewind();
            }
            foreach ($slis as $list) {
              // Use image card template
              $image = $list;
              include 'templates/image-card.php';
            }
          } else {
            // mysqli_result
            while ($list = mysqli_fetch_assoc($slis)) {
              // Use image card template
              $image = $list;
              include 'templates/image-card.php';
            }
          }
        } else {
          echo '<div class="alert alert-warning center w-full text-center text-white py-20 text-lg col-span-full">No results found. Try adjusting your filters or search terms.</div>';
        }
        ?>
      </div>

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
            class="flex items-center px-4 py-2 rounded gap-2 transition <?php echo (isset($page) && $page <= 1 ? 'bg-gray-600 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-800 hover:bg-gray-100'); ?>" <?php echo (isset($page) && $page <= 1 ? 'disabled' : ''); ?>>
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
          <input type="text" class="rounded bg-gray-600 w-12 px-2 py-1 text-center" value="<?php echo isset($page) ? $page : 1; ?>">
          of <?php echo isset($totalPages) ? $totalPages : 1; ?>
        </p>

        <!-- Next page button-->
        <div class="flex-1 flex justify-center">
          <button id="next-page-btn"
            class="flex items-center px-4 py-2 rounded gap-2 transition <?php echo (isset($page) && isset($totalPages) && $page >= $totalPages ? 'bg-gray-600 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-800 hover:bg-gray-100'); ?>"
            <?php echo (isset($page) && isset($totalPages) && $page >= $totalPages ? 'disabled' : ''); ?>>
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
          <input type="text" id="mobile-page-input" class="rounded bg-gray-600 w-12 px-2 py-1 text-center" value="<?php echo isset($page) ? $page : 1; ?>">
          of <span id="mobile-total-pages"><?php echo isset($totalPages) ? $totalPages : 1; ?></span>
        </p>

        <!-- Navigation buttons -->
        <div class="flex gap-3 w-full">
          <button id="mobile-prev-page-btn"
            class="flex-1 flex items-center justify-center px-4 py-3 rounded gap-2 transition text-sm <?php echo (isset($page) && $page <= 1 ? 'bg-gray-600 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-800 hover:bg-gray-100'); ?>" <?php echo (isset($page) && $page <= 1 ? 'disabled' : ''); ?>>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
            Previous
          </button>
          <button id="mobile-next-page-btn"
            class="flex-1 flex items-center justify-center px-4 py-3 rounded gap-2 transition text-sm <?php echo (isset($page) && isset($totalPages) && $page >= $totalPages ? 'bg-gray-600 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-800 hover:bg-gray-100'); ?>"
            <?php echo (isset($page) && isset($totalPages) && $page >= $totalPages ? 'disabled' : ''); ?>>
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

    <?php
    // Include footer section
    include 'includes/footer.php';
    ?>

  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
  <?php
  // Use minified version if available, otherwise fallback to source
  $scriptFile = file_exists('dist/script.min.js') ? 'dist/script.min.js' : 'script.js';
  $scriptVersion = file_exists($scriptFile) ? filemtime($scriptFile) : time();
  ?>
  <script src="<?php echo $scriptFile; ?>?v=<?php echo $scriptVersion; ?>"></script>
</body>

</html>