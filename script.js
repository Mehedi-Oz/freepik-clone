// =============================================================================
// I. SIDEBAR COLLAPSE FUNCTIONALITY
// =============================================================================
/**
 * Manages the collapsing and expanding of the main sidebar.
 * - It includes a manual toggle button for desktop view.
 * - It automatically collapses the sidebar on smaller screens (less than 1280px)
 *   and expands it on larger screens.
 */
document.addEventListener('DOMContentLoaded', function () {
  // DOM element references
  const sidebar = document.getElementById('logo-sidebar');
  const collapseBtn = document.getElementById('sidebar-collapse-btn');
  const mainContent = document.querySelector('.ml-64');
  const sidebarLogo = document.querySelector('.sidebar-logo');
  const sidebarDivider = document.querySelector('.sidebar-divider');
  const headerLogo = document.querySelector('header img');

  // State management for sidebar
  let isCollapsed = false;

  /**
   * Handles the responsive behavior of the sidebar based on window width.
   * Collapses the sidebar automatically on screens smaller than 1280px.
   */
  function handleResize() {
    const screenWidth = window.innerWidth;

    if (screenWidth < 1280) {
      // On smaller screens, the collapse is automatic, so the button is hidden.
      if (collapseBtn) {
        collapseBtn.style.display = 'none';
      }

      if (!isCollapsed) {
        isCollapsed = true;
        // Apply styles for a collapsed sidebar
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-16');
        mainContent.classList.remove('ml-64');
        mainContent.classList.add('ml-16');

        if (headerLogo) {
          headerLogo.classList.remove('hidden');
        }

        // Adjust various elements to fit the collapsed state
        sidebarLogo.classList.remove('justify-between');
        sidebarLogo.classList.add('justify-center');
        document.querySelectorAll('.sidebar-text').forEach(text => {
          text.classList.add('hidden');
        });
        document.getElementById('sidebar-logo-img').classList.add('hidden');
        sidebarDivider.classList.remove('mx');
        sidebarDivider.classList.add('mx-2');
        document.querySelector('.sidebar-signin').classList.add('hidden');
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
          link.classList.remove('p-2');
          link.classList.add('p-1', 'justify-center');
        });
        document.querySelectorAll('.sidebar-menu svg').forEach(svg => {
          svg.classList.add('m-1');
        });
        const helperIcons = document.querySelector('.sidebar-helper-icons .flex');
        helperIcons.classList.remove('justify-between');
        helperIcons.classList.add('flex-col', 'gap-2', 'items-center');
        const emailIcon = helperIcons.children[0].children[1];
        emailIcon.classList.add('hidden');
        const collapseIcon = collapseBtn.querySelector('svg');
        collapseIcon.classList.add('-rotate-90');
        document.querySelector('.sidebar-helper-icons .flex').classList.remove('justify-between');
        document.querySelector('.sidebar-helper-icons .flex').classList.add('justify-center');
        document.querySelector('.sidebar-helper-icons .flex > div').classList.remove('flex', 'gap-4');
        document.querySelector('.sidebar-helper-icons .flex > div').classList.add('flex-col', 'gap-2');
        document.querySelector('.sidebar-helper-icons .flex > div').children[1].classList.add('hidden');
      }
    } else if (screenWidth >= 1280) {
      // On larger screens, the collapse button is available.
      if (collapseBtn) {
        collapseBtn.style.display = 'block';
      }

      if (isCollapsed) {
        isCollapsed = false;
        // Restore styles for an expanded sidebar
        sidebar.classList.remove('w-16');
        sidebar.classList.add('w-64');
        mainContent.classList.remove('ml-16');
        mainContent.classList.add('ml-64');

        if (headerLogo) {
          headerLogo.classList.add('hidden');
        }

        // Restore element styles for the expanded state
        sidebarLogo.classList.add('justify-between');
        sidebarLogo.classList.remove('justify-center');
        setTimeout(() => {
          document.querySelectorAll('.sidebar-text').forEach(text => {
            text.classList.remove('hidden');
          });
          document.getElementById('sidebar-logo-img').classList.remove('hidden');
          document.querySelector('.sidebar-signin').classList.remove('hidden');
        }, 150); // Delay to sync with CSS transition
        sidebarDivider.classList.add('mx');
        sidebarDivider.classList.remove('mx-2');
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
          link.classList.add('p-2');
          link.classList.remove('p-1', 'justify-center');
        });
        document.querySelectorAll('.sidebar-menu svg').forEach(svg => {
          svg.classList.remove('m-1');
        });
        const helperIcons = document.querySelector('.sidebar-helper-icons .flex');
        helperIcons.classList.add('justify-between');
        helperIcons.classList.remove('flex-col', 'gap-2', 'items-center');
        const emailIcon = helperIcons.children[0].children[1];
        emailIcon.classList.remove('hidden');
        const collapseIcon = collapseBtn.querySelector('svg');
        collapseIcon.classList.remove('-rotate-90');
        document.querySelector('.sidebar-helper-icons .flex').classList.add('justify-between');
        document.querySelector('.sidebar-helper-icons .flex').classList.remove('justify-center');
        document.querySelector('.sidebar-helper-icons .flex > div').classList.add('flex', 'gap-4');
        document.querySelector('.sidebar-helper-icons .flex > div').classList.remove('flex-col', 'gap-2');
        document.querySelector('.sidebar-helper-icons .flex > div').children[1].classList.remove('hidden');
      }
    }
  }

  // Set initial state on page load
  window.addEventListener('resize', handleResize);
  handleResize();

  // Event listener for the manual collapse button
  collapseBtn?.addEventListener('click', function () {
    isCollapsed = !isCollapsed;

    if (isCollapsed) {
      // --- COLLAPSE LOGIC ---
      if (headerLogo) {
        headerLogo.classList.remove('hidden');
      }
      sidebar.classList.remove('w-64');
      sidebar.classList.add('w-16');
      mainContent.classList.remove('ml-64');
      mainContent.classList.add('ml-16');
      sidebarLogo.classList.remove('justify-between');
      sidebarLogo.classList.add('justify-center');
      document.querySelectorAll('.sidebar-text').forEach(text => {
        text.classList.add('hidden');
      });
      document.getElementById('sidebar-logo-img').classList.add('hidden');
      sidebarDivider.classList.remove('mx');
      sidebarDivider.classList.add('mx-2');
      document.querySelector('.sidebar-signin').classList.add('hidden');
      document.querySelectorAll('.sidebar-menu a').forEach(link => {
        link.classList.remove('p-2');
        link.classList.add('p-1', 'justify-center');
      });
      document.querySelectorAll('.sidebar-menu svg').forEach(svg => {
        svg.classList.add('m-1');
      });
      const helperIcons = document.querySelector('.sidebar-helper-icons .flex');
      helperIcons.classList.remove('justify-between');
      helperIcons.classList.add('flex-col', 'gap-2', 'items-center');
      const emailIcon = helperIcons.children[0].children[1];
      emailIcon.classList.add('hidden');
      document.querySelectorAll('.sidebar-helper-icons .p-2').forEach(icon => {
        icon.classList.remove('p-2');
        icon.classList.add('p-2');
      });
      const collapseIcon = collapseBtn.querySelector('svg');
      collapseIcon.classList.add('-rotate-90');
      document.querySelector('.sidebar-helper-icons .flex').classList.remove('justify-between');
      document.querySelector('.sidebar-helper-icons .flex').classList.add('justify-center');
      document.querySelector('.sidebar-helper-icons .flex > div').classList.remove('flex', 'gap-4');
      document.querySelector('.sidebar-helper-icons .flex > div').classList.add('flex-col', 'gap-2');
      document.querySelector('.sidebar-helper-icons .flex > div').children[1].classList.add('hidden');

    } else {
      // --- EXPAND LOGIC ---
      if (headerLogo) {
        headerLogo.classList.add('hidden');
      }
      sidebar.classList.remove('w-16');
      sidebar.classList.add('w-64');
      mainContent.classList.remove('ml-16');
      mainContent.classList.add('ml-64');
      sidebarLogo.classList.add('justify-between');
      sidebarLogo.classList.remove('justify-center');
      setTimeout(() => {
        document.querySelectorAll('.sidebar-text').forEach(text => {
          text.classList.remove('hidden');
        });
        document.getElementById('sidebar-logo-img').classList.remove('hidden');
        document.querySelector('.sidebar-signin').classList.remove('hidden');
      }, 150);
      sidebarDivider.classList.add('mx');
      sidebarDivider.classList.remove('mx-2');
      document.querySelectorAll('.sidebar-menu a').forEach(link => {
        link.classList.add('p-2');
        link.classList.remove('p-1', 'justify-center');
      });
      document.querySelectorAll('.sidebar-menu svg').forEach(svg => {
        svg.classList.remove('m-1');
      });
      const helperIcons = document.querySelector('.sidebar-helper-icons .flex');
      helperIcons.classList.add('justify-between');
      helperIcons.classList.remove('flex-col', 'gap-2', 'items-center');
      const emailIcon = helperIcons.children[0].children[1];
      emailIcon.classList.remove('hidden');
      const collapseIcon = collapseBtn.querySelector('svg');
      collapseIcon.classList.remove('-rotate-90');
      document.querySelector('.sidebar-helper-icons .flex').classList.add('justify-between');
      document.querySelector('.sidebar-helper-icons .flex').classList.remove('justify-center');
      document.querySelector('.sidebar-helper-icons .flex > div').classList.add('flex', 'gap-4');
      document.querySelector('.sidebar-helper-icons .flex > div').classList.remove('flex-col', 'gap-2');
      document.querySelector('.sidebar-helper-icons .flex > div').children[1].classList.remove('hidden');
    }
  });
});

// =============================================================================
// II. SEARCH BAR CLEAR BUTTON
// =============================================================================
/**
 * Shows a clear button (X) in the search bar when there is input text.
 * Allows the user to quickly clear the search query.
 */
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.querySelector('input[type="search"]');
  const clearIcon = document.querySelector('.absolute.right-20');

  if (searchInput && clearIcon) {
    /**
     * Toggles the visibility of the clear icon based on search input content.
     */
    function toggleClearButton() {
      if (searchInput.value.trim() !== '') {
        clearIcon.classList.remove('hidden');
      } else {
        clearIcon.classList.add('hidden');
      }
    }

    // Event listeners for real-time feedback
    searchInput.addEventListener('input', toggleClearButton);
    clearIcon.addEventListener('click', function () {
      searchInput.value = '';
      toggleClearButton();
      searchInput.focus();
    });

    // Initial state check
    toggleClearButton();
  }
});

// =============================================================================
// III. DESKTOP NAVIGATION ACTIVE STATE
// =============================================================================
/**
 * Manages the visual active state (underline) for the main desktop navigation items.
 */
document.addEventListener('DOMContentLoaded', function () {
  const navItems = document.querySelectorAll('.nav-item');
  const moreBtn = document.getElementById('more-btn');

  // Add click listeners to all navigation items
  navItems.forEach(item => {
    item.addEventListener('click', function () {
      // Reset all items before setting the new active one
      navItems.forEach(nav => nav.classList.remove('active'));
      if (moreBtn) moreBtn.classList.remove('active');
      this.classList.add('active');
    });
  });

  // Special handling for the "More" button
  if (moreBtn) {
    moreBtn.addEventListener('click', function () {
      navItems.forEach(nav => nav.classList.remove('active'));
      this.classList.add('active');
    });
  }

  // Set the first item as active by default
  const defaultItem = document.querySelector('.nav-item');
  if (defaultItem) {
    defaultItem.classList.add('active');
  }
});

// =============================================================================
// IV. RESPONSIVE "MORE" BUTTON FOR NAVIGATION
// =============================================================================
/**
 * Dynamically moves navigation items into a "More" dropdown when there
 * is not enough horizontal space to display them all.
 */
document.addEventListener('DOMContentLoaded', function () {
  // DOM element references
  const navbarContainer = document.querySelector('nav .flex.justify-between.items-center');
  const navbarMenu = document.getElementById('navbar-menu');
  const moreBtn = document.getElementById('more-btn');
  const hiddenItems = document.getElementById('hidden-items');
  const rightSection = navbarContainer.querySelector('ul:last-child');
  const filtersSection = document.getElementById('filters-section');

  // State management
  let allItems = [];
  let isMoreOpen = false;

  /**
   * Initializes the navigation items array from the DOM.
   */
  function initNavbar() {
    const items = navbarMenu.querySelectorAll('.nav-item:not(#more-btn)');
    allItems = Array.from(items);
  }

  /**
   * Checks if all navigation items fit and moves them to the "More"
   * dropdown if necessary.
   */
  function checkNavbarFit() {
    if (allItems.length === 0) return;

    // Calculate available width, accounting for other elements in the navbar
    const containerWidth = navbarContainer.offsetWidth;
    const rightSectionWidth = rightSection.offsetWidth;
    const filtersSectionWidth = filtersSection ? filtersSection.offsetWidth : 0;
    const usedSpace = rightSectionWidth + Math.min(filtersSectionWidth, containerWidth * 0.3);
    const containerPadding = 48;
    const availableWidth = containerWidth - usedSpace - containerPadding;

    let currentWidth = 0;
    let visibleCount = 0;
    const itemGap = 16; // Gap between items
    const moreButtonWidth = 80; // Estimated width of the "More" button

    // Determine how many items can be visible
    for (let i = 0; i < allItems.length; i++) {
      const itemWidth = allItems[i].offsetWidth + itemGap;
      const willNeedMoreButton = (i < allItems.length - 1);
      const totalNeeded = currentWidth + itemWidth + (willNeedMoreButton ? moreButtonWidth : 0);

      if (totalNeeded <= availableWidth) {
        currentWidth += itemWidth;
        visibleCount++;
      } else {
        break;
      }
    }

    // Toggle visibility of items based on calculation
    allItems.forEach((item, index) => {
      item.classList.toggle('hidden', index >= visibleCount);
    });

    // Manage the "More" button and its dropdown
    if (visibleCount < allItems.length) {
      moreBtn.classList.remove('hidden');
      updateMoreDropdown(visibleCount);
    } else {
      moreBtn.classList.add('hidden');
      hiddenItems.innerHTML = '';
      isMoreOpen = false;
    }
  }

  /**
   * Populates the "More" dropdown with items that are currently hidden.
   * @param {number} visibleCount - The number of items currently visible in the main navbar.
   */
  function updateMoreDropdown(visibleCount) {
    hiddenItems.innerHTML = '';
    hiddenItems.style.display = 'none';

    for (let i = visibleCount; i < allItems.length; i++) {
      const li = document.createElement('li');
      li.className = 'block px-4 py-2 text-white cursor-pointer hover:bg-gray-700 whitespace-nowrap';
      li.textContent = allItems[i].textContent.trim();
      li.addEventListener('click', (e) => {
        e.stopPropagation();
        hiddenItems.style.display = 'none';
        isMoreOpen = false;
      });
      hiddenItems.appendChild(li);
    }
  }

  // Event listener for the "More" button
  moreBtn.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    isMoreOpen = !isMoreOpen;
    hiddenItems.style.display = isMoreOpen ? 'block' : 'none';
  });

  // Global click listener to close the dropdown when clicking outside
  document.addEventListener('click', function (e) {
    if (isMoreOpen && !moreBtn.contains(e.target) && !hiddenItems.contains(e.target)) {
      hiddenItems.style.display = 'none';
      isMoreOpen = false;
    }
  });

  // Initial setup and responsive listeners
  setTimeout(() => {
    initNavbar();
    checkNavbarFit();
  }, 300); // Delay to ensure all elements are rendered

  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(checkNavbarFit, 150);
  });

  // Re-check when filters are shown/hidden as it affects available space
  if (filtersSection) {
    new MutationObserver(() => {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(checkNavbarFit, 100);
    }).observe(filtersSection, {
      attributes: true,
      attributeFilter: ['class', 'style']
    });
  }
});

// =============================================================================
// V. GLOBAL POPUP/DETAILS CLOSE HANDLER
// =============================================================================
/**
 * Closes any open <details> elements (like the theme switcher) when a click
 * occurs outside of them.
 */
document.addEventListener('click', function (e) {
  const details = document.querySelectorAll('details');
  details.forEach(detail => {
    if (detail.open && !detail.contains(e.target)) {
      detail.open = false;
    }
  });
});

// =============================================================================
// VI. DESKTOP FILTER SECTION TOGGLE
// =============================================================================
/**
 * Toggles the visibility of the main filter bar on desktop view.
 */
const chevron = document.querySelector('.chevron');
const target = document.getElementById('filters-section');
let isDown = false;

chevron?.addEventListener('click', () => {
  chevron.innerHTML = isDown
    ? `<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />`
    : `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />`;
  isDown = !isDown;
  if (target) {
    target.style.display = target.style.display === 'none' ? 'flex' : 'none';
  }
});

// =============================================================================
// VII. DESKTOP RELEVANCE/SORT POPUP TOGGLE
// =============================================================================
/**
 * Toggles the visibility of the "Relevance" or "Sort by" popup on desktop.
 */
const relevanceChevron = document.getElementById('relevance-chevron');
const relevancePopup = document.getElementById('relevance-popup');

relevanceChevron?.addEventListener('click', () => {
  relevancePopup.classList.toggle('hidden');
});

// =============================================================================
// VIII. DESKTOP FILTER POPUPS MANAGER
// =============================================================================
/**
 * Manages the behavior of all filter popups on the desktop view.
 * - Ensures only one popup can be open at a time.
 * - Handles correct positioning relative to the trigger button.
 * - Closes popups when clicking outside.
 */
document.addEventListener('DOMContentLoaded', () => {
  // Configuration for all filter popups
  const filterElements = [
    { btn: 'license-btn', popup: 'license-popup', chevron: 'license-chevron' },
    { btn: 'ai-btn', popup: 'ai-popup', chevron: 'ai-chevron' },
    { btn: 'orientation-btn', popup: 'orientation-popup', chevron: 'orientation-chevron' },
    { btn: 'color-btn', popup: 'color-popup', chevron: 'color-chevron' },
    { btn: 'people-btn', popup: 'people-popup', chevron: 'people-chevron' },
    { btn: 'filetype-btn', popup: 'filetype-popup', chevron: 'filetype-chevron' },
    { btn: 'advanced-btn', popup: 'advanced-popup', chevron: 'advanced-chevron' }
  ];

  // Configuration for nested popups (e.g., within the "People" filter)
  const nestedElements = [
    { btn: 'gender-btn', popup: 'gender-popup', chevron: 'gender-chevron' },
    { btn: 'age-btn', popup: 'age-popup', chevron: 'age-chevron' },
    { btn: 'ethnicity-btn', popup: 'ethnicity-popup', chevron: 'ethnicity-chevron' }
  ];

  /**
   * Positions a popup correctly below its trigger button.
   * This is crucial for popups in a sticky or scrolling header.
   * @param {HTMLElement} button - The button that triggers the popup.
   * @param {HTMLElement} popup - The popup element to position.
   */
  function positionPopup(button, popup) {
    const buttonRect = button.getBoundingClientRect();
    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
    popup.style.left = (buttonRect.left + scrollLeft) + 'px';
    popup.style.top = (buttonRect.bottom + 8) + 'px'; // 8px gap
  }

  /**
   * Closes all open popups.
   * @param {HTMLElement} [except=null] - A popup element to exclude from closing.
   */
  function closeAllPopups(except = null) {
    [...filterElements, ...nestedElements].forEach(element => {
      const popup = document.getElementById(element.popup);
      const chevron = document.getElementById(element.chevron);
      if (popup && popup !== except) {
        popup.classList.add('hidden');
        popup.style.display = '';
      }
      if (chevron && chevron !== except?.previousElementSibling?.querySelector('svg')) {
        chevron.classList.remove('rotate-180');
      }
    });
  }

  // Add event listeners for main filter buttons
  filterElements.forEach(element => {
    const btn = document.getElementById(element.btn);
    const popup = document.getElementById(element.popup);
    const chevron = document.getElementById(element.chevron);

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = popup.classList.contains('hidden');
        closeAllPopups(popup);
        if (isHidden) {
          positionPopup(btn, popup);
          popup.classList.remove('hidden');
          if (chevron) chevron.classList.add('rotate-180');
        }
      });
      popup.addEventListener('click', (e) => e.stopPropagation());
    }
  });

  // Add event listeners for nested filter buttons
  nestedElements.forEach(element => {
    const btn = document.getElementById(element.btn);
    const popup = document.getElementById(element.popup);
    const chevron = document.getElementById(element.chevron);

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = popup.classList.contains('hidden');
        // Close only other nested popups
        nestedElements.forEach(other => {
          if (other.popup !== element.popup) {
            document.getElementById(other.popup)?.classList.add('hidden');
            document.getElementById(other.chevron)?.classList.remove('rotate-180');
          }
        });
        if (isHidden) {
          popup.classList.remove('hidden');
          if (chevron) chevron.classList.add('rotate-180');
        } else {
          popup.classList.add('hidden');
          if (chevron) chevron.classList.remove('rotate-180');
        }
      });
      popup.addEventListener('click', (e) => e.stopPropagation());
    }
  });

  // Global click listener to close all popups
  document.addEventListener('click', (e) => {
    const isInsideFilter = e.target.closest('[id$="-btn"], [id$="-chevron"], [id$="-popup"]');
    if (!isInsideFilter) {
      closeAllPopups();
    }
  });

  // Reposition popups on scroll and resize to keep them anchored
  window.addEventListener('scroll', () => {
    filterElements.forEach(element => {
      const btn = document.getElementById(element.btn);
      const popup = document.getElementById(element.popup);
      if (btn && popup && !popup.classList.contains('hidden')) {
        positionPopup(btn, popup);
      }
    });
  });
  window.addEventListener('resize', () => {
    filterElements.forEach(element => {
      const btn = document.getElementById(element.btn);
      const popup = document.getElementById(element.popup);
      if (btn && popup && !popup.classList.contains('hidden')) {
        positionPopup(btn, popup);
      }
    });
  });

  // Ensure all popups are hidden on initial load
  [...filterElements, ...nestedElements].forEach(element => {
    const popup = document.getElementById(element.popup);
    if (popup) {
      popup.classList.add('hidden');
      popup.style.display = '';
    }
  });
});

// =============================================================================
// IX. BUTTON GROUP ACTIVE STATE
// =============================================================================
/**
 * Manages the visual active state for button groups (e.g., People count,
 * Author mode, Result variety).
 */
document.querySelectorAll('.people-count-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.people-count-btn').forEach(b => b.classList.remove('bg-green-600'));
    this.classList.add('bg-green-600');
  });
});
document.querySelectorAll('.author-mode-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.author-mode-btn').forEach(b => b.classList.remove('bg-green-600'));
    this.classList.add('bg-green-600');
  });
});
document.querySelectorAll('.result-variety-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.result-variety-btn').forEach(b => b.classList.remove('bg-green-600'));
    this.classList.add('bg-green-600');
  });
});

// =============================================================================
// X. MOBILE SIDEBAR & OVERLAY
// =============================================================================
/**
 * Manages the slide-in sidebar for mobile view, including the overlay that
 * covers the main content.
 */
document.addEventListener('DOMContentLoaded', function () {
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');
  const mobileSidebar = document.getElementById('mobile-sidebar');
  const mobileSidebarClose = document.getElementById('mobile-sidebar-close');

  // Open sidebar
  mobileMenuBtn?.addEventListener('click', function () {
    mobileSidebarOverlay.classList.remove('hidden');
    setTimeout(() => mobileSidebar.classList.remove('-translate-x-full'), 10);
  });

  // Close sidebar via button
  mobileSidebarClose?.addEventListener('click', function () {
    mobileSidebar.classList.add('-translate-x-full');
    setTimeout(() => mobileSidebarOverlay.classList.add('hidden'), 300);
  });

  // Close sidebar by clicking the overlay
  mobileSidebarOverlay?.addEventListener('click', function (e) {
    if (e.target === mobileSidebarOverlay) {
      mobileSidebar.classList.add('-translate-x-full');
      setTimeout(() => mobileSidebarOverlay.classList.add('hidden'), 300);
    }
  });
});

// =============================================================================
// XI. MOBILE NAVIGATION DROPDOWNS & SCROLL LOCK
// =============================================================================
/**
 * Manages the three main navigation dropdowns on mobile ("All Images",
 * "Filters", "Settings") and locks the body scroll when one is open.
 */
document.addEventListener('DOMContentLoaded', function () {
  const mobileAllImagesBtn = document.getElementById('mobile-all-images-btn');
  const mobileFiltersBtn = document.getElementById('mobile-filters-btn');
  const mobileSettingsBtn = document.getElementById('mobile-settings-btn');

  const mobileAllImagesDropdown = document.getElementById('mobile-all-images-dropdown');
  const mobileFiltersDropdown = document.getElementById('mobile-filters-dropdown');
  const mobileSettingsDropdown = document.getElementById('mobile-settings-dropdown');

  /**
   * Closes all mobile dropdowns and unlocks body scroll.
   */
  function closeAllMobileDropdowns() {
    if (mobileAllImagesDropdown) {
      mobileAllImagesDropdown.style.display = 'none';
      mobileAllImagesDropdown.classList.add('hidden');
    }
    if (mobileFiltersDropdown) {
      mobileFiltersDropdown.style.display = 'none';
      mobileFiltersDropdown.classList.add('hidden');
    }
    if (mobileSettingsDropdown) {
      mobileSettingsDropdown.style.display = 'none';
      mobileSettingsDropdown.classList.add('hidden');
    }
    // Crucially, remove the scroll lock when all dropdowns are closed.
    document.body.classList.remove('no-scroll');
  }

  /**
   * Generic handler for a mobile dropdown button click.
   * @param {HTMLElement} dropdown - The dropdown to toggle.
   */
  function handleDropdownClick(dropdown) {
    const isVisible = dropdown.style.display === 'block';
    closeAllMobileDropdowns();
    if (!isVisible) {
      dropdown.style.display = 'block';
      dropdown.classList.remove('hidden');
      // Lock the body scroll when a dropdown is open.
      document.body.classList.add('no-scroll');
    }
  }

  // Event listeners for each button
  mobileAllImagesBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    handleDropdownClick(mobileAllImagesDropdown);
  });

  mobileFiltersBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    handleDropdownClick(mobileFiltersDropdown);
  });

  mobileSettingsBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    handleDropdownClick(mobileSettingsDropdown);
  });

  // Global click listener to close dropdowns
  document.addEventListener('click', function (e) {
    const isInsideNav = e.target.closest('#mobile-nav-buttons, #mobile-all-images-dropdown, #mobile-filters-dropdown, #mobile-settings-dropdown');
    if (!isInsideNav) {
      closeAllMobileDropdowns();
    }
  });

  // Update button text and close dropdown on selection
  const radioButtons = document.querySelectorAll('input[name="mobile-navigation"]');
  radioButtons.forEach(radio => {
    radio.addEventListener('change', function () {
      if (this.checked) {
        const selectedText = this.parentElement.querySelector('span').textContent;
        mobileAllImagesBtn.textContent = selectedText;
        setTimeout(closeAllMobileDropdowns, 200);
      }
    });
  });
});

// =============================================================================
// XII. MOBILE FILTER POPUPS
// =============================================================================
/**
 * Manages the individual filter popups within the main "Filters" dropdown
 * on mobile view.
 */
document.addEventListener('DOMContentLoaded', function () {
  const mobileFilterElements = [
    { btn: 'mobile-license-btn', popup: 'mobile-license-popup' },
    { btn: 'mobile-ai-btn', popup: 'mobile-ai-popup' },
    { btn: 'mobile-orientation-btn', popup: 'mobile-orientation-popup' },
    { btn: 'mobile-color-btn', popup: 'mobile-color-popup' },
    { btn: 'mobile-people-btn', popup: 'mobile-people-popup' },
    { btn: 'mobile-filetype-btn', popup: 'mobile-filetype-popup' },
    { btn: 'mobile-sort-btn', popup: 'mobile-sort-popup' }
  ];

  /**
   * Closes all individual filter popups.
   */
  function closeAllMobileFilterPopups() {
    mobileFilterElements.forEach(element => {
      const popup = document.getElementById(element.popup);
      const btn = document.getElementById(element.btn);
      if (popup) {
        popup.classList.add('hidden');
        popup.style.display = 'none';
      }
      if (btn) {
        btn.querySelector('svg')?.classList.remove('rotate-180');
      }
    });
  }

  // Add event listeners for each filter button
  mobileFilterElements.forEach(element => {
    const btn = document.getElementById(element.btn);
    const popup = document.getElementById(element.popup);

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = popup.classList.contains('hidden');
        closeAllMobileFilterPopups(); // Ensure only one is open
        if (isHidden) {
          popup.classList.remove('hidden');
          popup.style.display = 'block';
          btn.querySelector('svg')?.classList.add('rotate-180');
        }
      });
      popup.addEventListener('click', (e) => e.stopPropagation());
    }
  });
});

// =============================================================================
// XIII. FOOTER MOBILE COLLAPSIBLE SECTIONS
// =============================================================================
/**
 * Manages the collapsible accordion sections in the footer for mobile view.
 */
document.addEventListener('DOMContentLoaded', function () {
  const footerToggles = [
    { btn: 'products-toggle', list: 'products-list', arrow: 'products-arrow' },
    { btn: 'get-started-toggle', list: 'get-started-list', arrow: 'get-started-arrow' },
    { btn: 'company-toggle', list: 'company-list', arrow: 'company-arrow' }
  ];

  footerToggles.forEach(toggle => {
    const btn = document.getElementById(toggle.btn);
    const list = document.getElementById(toggle.list);
    const arrow = document.getElementById(toggle.arrow);

    btn?.addEventListener('click', function () {
      list.classList.toggle('hidden');
      arrow.classList.toggle('rotate-180');
    });
  });
});

// =============================================================================
// XIV. DYNAMIC IMAGE CARD ICONS
// =============================================================================
/**
 * Dynamically generates interactive overlay icons for image cards
 * while keeping images static in HTML
 */
document.addEventListener('DOMContentLoaded', function () {

  // SVG icon templates
  const icons = {
    download: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
    </svg>`,

    edit: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />
    </svg>`,

    save: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
    </svg>`,

    search: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607Z" />
    </svg>`
  };

  /**
   * Creates the overlay elements for an image card
   */
  function createImageOverlay() {
    return `
      <!-- Dark overlay -->
      <div class="overlay absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 rounded-lg"></div>
      
      <!-- Top action buttons -->
      <div class="action-buttons absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex gap-2">
        <button title="Download" class="download-btn p-2 bg-gray-800 rounded-full text-white hover:bg-gray-700 transition" data-action="download">
          ${icons.download}
        </button>
        <button title="Edit with AI" class="edit-btn p-2 bg-gray-800 rounded-full text-white hover:bg-gray-700 transition" data-action="edit">
          ${icons.edit}
        </button>
        <button title="Save to collection" class="save-btn p-2 bg-gray-800 rounded-full text-white hover:bg-gray-700 transition" data-action="save">
          ${icons.save}
        </button>
      </div>
      
      <!-- Bottom discover button -->
      <div class="discover-section absolute bottom-2 left-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <button class="discover-btn flex items-center gap-2 text-white bg-gray-800 bg-opacity-70 rounded-full px-3 py-1 text-sm hover:bg-opacity-90 transition" data-action="discover">
          ${icons.search}
          Discover similar
        </button>
      </div>
    `;
  }

  /**
   * Initialize all image cards with dynamic overlays
   */
  function initializeImageCards() {
    const imageCards = document.querySelectorAll('.image-card');

    imageCards.forEach(card => {
      // Add overlay elements
      card.innerHTML += createImageOverlay();

      // Add click event listeners for each action
      const downloadBtn = card.querySelector('.download-btn');
      const editBtn = card.querySelector('.edit-btn');
      const saveBtn = card.querySelector('.save-btn');
      const discoverBtn = card.querySelector('.discover-btn');

      const imageId = card.dataset.image;
      const imageAlt = card.querySelector('img').alt;

      // Download functionality
      downloadBtn.addEventListener('click', (e) => {
        e.preventDefault();
        handleImageAction('download', imageId, imageAlt);
      });

      // Edit functionality
      editBtn.addEventListener('click', (e) => {
        e.preventDefault();
        handleImageAction('edit', imageId, imageAlt);
      });

      // Save functionality
      saveBtn.addEventListener('click', (e) => {
        e.preventDefault();
        handleImageAction('save', imageId, imageAlt);
      });

      // Discover similar functionality
      discoverBtn.addEventListener('click', (e) => {
        e.preventDefault();
        handleImageAction('discover', imageId, imageAlt);
      });
    });
  }

  /**
   * Handle different image actions
   */
  function handleImageAction(action, imageId, imageAlt) {
    switch (action) {
      case 'download':
        console.log(`Downloading image ${imageId}: ${imageAlt}`);
        // Download logic here
        downloadImage(imageId);
        break;

      case 'edit':
        console.log(`Editing image ${imageId}: ${imageAlt}`);
        // Edit logic here
        openImageEditor(imageId);
        break;

      case 'save':
        console.log(`Saving image ${imageId}: ${imageAlt}`);
        // Save logic here
        saveToCollection(imageId);
        showNotification('Image saved to collection!');
        break;

      case 'discover':
        console.log(`Finding similar images to ${imageId}: ${imageAlt}`);
        // Discover logic here
        findSimilarImages(imageId);
        break;

      default:
        console.log('Unknown action:', action);
    }
  }


  // INITIALIZATION
  // Start the image card system once the DOM is fully loaded
  initializeImageCards();
});