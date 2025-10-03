// ========== Sidebar Collapse Functionality ==========
document.addEventListener('DOMContentLoaded', function () {
  const sidebar = document.getElementById('logo-sidebar');
  const collapseBtn = document.getElementById('sidebar-collapse-btn');
  const mainContent = document.querySelector('.ml-64');
  const sidebarLogo = document.querySelector('.sidebar-logo');
  const sidebarDivider = document.querySelector('.sidebar-divider');
  const headerLogo = document.querySelector('header img');

  let isCollapsed = false;

  function handleResize() {
    const screenWidth = window.innerWidth;

    if (screenWidth < 1280) {
      // Hide collapse button on smaller screens
      if (collapseBtn) {
        collapseBtn.style.display = 'none';
      }

      if (!isCollapsed) {
        // Auto-collapse when screen goes below 1280px
        isCollapsed = true;
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-16');
        mainContent.classList.remove('ml-64');
        mainContent.classList.add('ml-16');

        // Show header logo when sidebar is collapsed
        if (headerLogo) {
          headerLogo.classList.remove('hidden');
        }

        // Apply all collapse styles
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
      // Show collapse button on larger screens
      if (collapseBtn) {
        collapseBtn.style.display = 'block';
      }

      if (isCollapsed) {
        // Auto-expand when screen goes back to 1280px or above
        isCollapsed = false;
        sidebar.classList.remove('w-16');
        sidebar.classList.add('w-64');
        mainContent.classList.remove('ml-16');
        mainContent.classList.add('ml-64');

        // Hide header logo when sidebar is expanded
        if (headerLogo) {
          headerLogo.classList.add('hidden');
        }

        // Apply all expand styles
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
    }
  }

  // Listen for window resize
  window.addEventListener('resize', handleResize);

  // Check initial screen size on load
  handleResize();

  collapseBtn?.addEventListener('click', function () {
    isCollapsed = !isCollapsed;

    if (isCollapsed) {
      // Show header logo when sidebar is collapsed
      if (headerLogo) {
        headerLogo.classList.remove('hidden');
      }

      // Collapse sidebar
      sidebar.classList.remove('w-64');
      sidebar.classList.add('w-16');

      // Adjust main content margin
      mainContent.classList.remove('ml-64');
      mainContent.classList.add('ml-16');

      // Center the collapse button
      sidebarLogo.classList.remove('justify-between');
      sidebarLogo.classList.add('justify-center');

      // Hide text elements
      document.querySelectorAll('.sidebar-text').forEach(text => {
        text.classList.add('hidden');
      });

      // Hide logo
      document.getElementById('sidebar-logo-img').classList.add('hidden');

      // Adjust divider for collapsed state
      sidebarDivider.classList.remove('mx');
      sidebarDivider.classList.add('mx-2');

      // Hide sign-in section
      document.querySelector('.sidebar-signin').classList.add('hidden');

      // Remove padding from menu items and center icons
      document.querySelectorAll('.sidebar-menu a').forEach(link => {
        link.classList.remove('p-2');
        link.classList.add('p-1', 'justify-center');
      });

      // Add margin to SVG icons in menu
      document.querySelectorAll('.sidebar-menu svg').forEach(svg => {
        svg.classList.add('m-1');
      });

      // Adjust helper icons layout
      const helperIcons = document.querySelector('.sidebar-helper-icons .flex');
      helperIcons.classList.remove('justify-between');
      helperIcons.classList.add('flex-col', 'gap-2', 'items-center');

      // Hide email icon (keep only question, theme, and dots)
      const emailIcon = helperIcons.children[0].children[1];
      emailIcon.classList.add('hidden');

      // Remove padding from helper icons and make them larger
      document.querySelectorAll('.sidebar-helper-icons .p-2').forEach(icon => {
        icon.classList.remove('p-2');
        icon.classList.add('p-2');
      });

      // Rotate collapse button icon
      const collapseIcon = collapseBtn.querySelector('svg');
      collapseIcon.classList.add('-rotate-90');

      // Adjust helper icons for collapsed state
      document.querySelector('.sidebar-helper-icons .flex').classList.remove('justify-between');
      document.querySelector('.sidebar-helper-icons .flex').classList.add('justify-center');
      document.querySelector('.sidebar-helper-icons .flex > div').classList.remove('flex', 'gap-4');
      document.querySelector('.sidebar-helper-icons .flex > div').classList.add('flex-col', 'gap-2');

      // Hide message box icon
      document.querySelector('.sidebar-helper-icons .flex > div').children[1].classList.add('hidden');

    } else {
      // Hide header logo when sidebar is expanded
      if (headerLogo) {
        headerLogo.classList.add('hidden');
      }

      // Expand sidebar
      sidebar.classList.remove('w-16');
      sidebar.classList.add('w-64');

      // Adjust main content margin
      mainContent.classList.remove('ml-16');
      mainContent.classList.add('ml-64');

      // Restore collapse button alignment
      sidebarLogo.classList.add('justify-between');
      sidebarLogo.classList.remove('justify-center');

      // Delay showing elements to prevent white flash
      setTimeout(() => {
        // Show text elements
        document.querySelectorAll('.sidebar-text').forEach(text => {
          text.classList.remove('hidden');
        });

        // Show logo
        document.getElementById('sidebar-logo-img').classList.remove('hidden');

        // Show sign-in section
        document.querySelector('.sidebar-signin').classList.remove('hidden');
      }, 150);

      // Restore divider immediately
      sidebarDivider.classList.add('mx');
      sidebarDivider.classList.remove('mx-2');

      // Restore padding to menu items
      document.querySelectorAll('.sidebar-menu a').forEach(link => {
        link.classList.add('p-2');
        link.classList.remove('p-1', 'justify-center');
      });

      // Remove margin from SVG icons in menu
      document.querySelectorAll('.sidebar-menu svg').forEach(svg => {
        svg.classList.remove('m-1');
      });

      // Restore helper icons layout
      const helperIcons = document.querySelector('.sidebar-helper-icons .flex');
      helperIcons.classList.add('justify-between');
      helperIcons.classList.remove('flex-col', 'gap-2', 'items-center');

      // Show email icon
      const emailIcon = helperIcons.children[0].children[1];
      emailIcon.classList.remove('hidden');

      // Rotate collapse button icon back
      const collapseIcon = collapseBtn.querySelector('svg');
      collapseIcon.classList.remove('-rotate-90');

      // Restore helper icons for expanded state
      document.querySelector('.sidebar-helper-icons .flex').classList.add('justify-between');
      document.querySelector('.sidebar-helper-icons .flex').classList.remove('justify-center');
      document.querySelector('.sidebar-helper-icons .flex > div').classList.add('flex', 'gap-4');
      document.querySelector('.sidebar-helper-icons .flex > div').classList.remove('flex-col', 'gap-2');

      // Show message box icon
      document.querySelector('.sidebar-helper-icons .flex > div').children[1].classList.remove('hidden');
    }
  });
});



// ========== Search Bar Clear Button Functionality ==========
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.querySelector('input[type="search"]');
  const clearIcon = document.querySelector('.absolute.right-20');
  if (searchInput && clearIcon) {
    // Function to toggle clear button visibility
    function toggleClearButton() {
      if (searchInput.value.trim() !== '') {
        clearIcon.classList.remove('hidden');
      } else {
        clearIcon.classList.add('hidden');
      }
    }

    // Show/hide clear button on input
    searchInput.addEventListener('input', toggleClearButton);

    // Clear the input when clear button is clicked
    clearIcon.addEventListener('click', function () {
      searchInput.value = '';
      clearIcon.classList.add('hidden');
      searchInput.focus();
    });

    // Initial check on page load
    toggleClearButton();
  }
});


// ========== PC Navigation Active State ==========
document.addEventListener('DOMContentLoaded', function () {
  const navItems = document.querySelectorAll('.nav-item');
  const moreBtn = document.getElementById('more-btn');

  // Handle nav item clicks
  navItems.forEach(item => {
    item.addEventListener('click', function () {
      // Remove active class from all nav items
      navItems.forEach(nav => nav.classList.remove('active'));
      if (moreBtn) moreBtn.classList.remove('active');

      // Add active class to clicked item
      this.classList.add('active');

      console.log('Selected:', this.textContent.trim());
    });
  });

  // Handle more button click
  if (moreBtn) {
    moreBtn.addEventListener('click', function () {
      // Remove active class from all nav items
      navItems.forEach(nav => nav.classList.remove('active'));

      // Add active class to more button
      this.classList.add('active');

      console.log('Selected: More');
    });
  }

  const defaultItem = document.querySelector('.nav-item');
  if (defaultItem) {
    defaultItem.classList.add('active');
  }
});


// ========== Responsive Navbar with More Button ==========
document.addEventListener('DOMContentLoaded', function () {
  const navbarContainer = document.querySelector('nav .flex.justify-between.items-center');
  const navbarMenu = document.getElementById('navbar-menu');
  const moreBtn = document.getElementById('more-btn');
  const hiddenItems = document.getElementById('hidden-items');
  const rightSection = navbarContainer.querySelector('ul:last-child');
  const filtersSection = document.getElementById('filters-section');
  let allItems = [];
  let isMoreOpen = false;

  // Initialize navbar items
  function initNavbar() {
    const items = navbarMenu.querySelectorAll('.nav-item:not(#more-btn)');
    allItems = Array.from(items);
    console.log('Found navigation items:', allItems.length);
  }

  // Calculate available space considering both right section AND filters section
  function checkNavbarFit() {
    if (allItems.length === 0) {
      console.log('No navigation items found');
      return;
    }

    const containerWidth = navbarContainer.offsetWidth;
    const rightSectionWidth = rightSection.offsetWidth;
    const filtersSectionWidth = filtersSection ? filtersSection.offsetWidth : 0;
    const usedSpace = rightSectionWidth + Math.min(filtersSectionWidth, containerWidth * 0.3);
    const containerPadding = 48;
    const availableWidth = containerWidth - usedSpace - containerPadding;

    let currentWidth = 0;
    let visibleCount = 0;
    const itemGap = 16;
    const moreButtonWidth = 80;

    // Calculate how many items can fit
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

    console.log(`Visible items: ${visibleCount}, Total items: ${allItems.length}`);

    // Apply visibility changes
    allItems.forEach((item, index) => {
      if (index < visibleCount) {
        item.classList.remove('hidden');
      } else {
        item.classList.add('hidden');
      }
    });

    // Show/hide More button and update dropdown
    if (visibleCount < allItems.length) {
      moreBtn.classList.remove('hidden');
      updateMoreDropdown(visibleCount);
      console.log('More button shown, hidden items:', allItems.length - visibleCount);
    } else {
      moreBtn.classList.add('hidden');
      hiddenItems.innerHTML = '';
      isMoreOpen = false;
      console.log('More button hidden - all items fit');
    }
  }

  // Update More dropdown with hidden items
  function updateMoreDropdown(visibleCount) {
    hiddenItems.innerHTML = '';
    hiddenItems.style.display = 'none'; // Start hidden

    // Add hidden navigation items to dropdown
    for (let i = visibleCount; i < allItems.length; i++) {
      const li = document.createElement('li');
      li.className = 'block px-4 py-2 text-white cursor-pointer hover:bg-gray-700 whitespace-nowrap';
      li.textContent = allItems[i].textContent.trim();

      // Add click handler for dropdown items
      li.addEventListener('click', function (e) {
        e.stopPropagation();
        console.log('Clicked hidden item:', this.textContent);
        hiddenItems.style.display = 'none';
        isMoreOpen = false;
      });

      hiddenItems.appendChild(li);
      console.log('Added item to dropdown:', allItems[i].textContent);
    }

    console.log(`Added ${allItems.length - visibleCount} items to dropdown`);
  }

  // Toggle More dropdown
  moreBtn.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();

    isMoreOpen = !isMoreOpen;
    console.log('More button clicked, isOpen:', isMoreOpen);

    if (isMoreOpen) {
      hiddenItems.classList.remove('hidden');
      hiddenItems.style.display = 'block';
      console.log('Dropdown opened');
      console.log('Dropdown position:', hiddenItems.getBoundingClientRect());
      console.log('Dropdown has children:', hiddenItems.children.length);
    } else {
      hiddenItems.classList.add('hidden');
      hiddenItems.style.display = 'none';
      console.log('Dropdown closed');
    }
  });

  // Close dropdown when clicking outside
  document.addEventListener('click', function (e) {
    if (isMoreOpen && !moreBtn.contains(e.target) && !hiddenItems.contains(e.target)) {
      hiddenItems.classList.add('hidden');
      hiddenItems.style.display = 'none';
      isMoreOpen = false;
      console.log('Dropdown closed by outside click');
    }
  });

  // Initialize with delay and check both on load and when filters change
  setTimeout(() => {
    initNavbar();
    checkNavbarFit();
  }, 300);

  // Debounced resize handler
  let resizeTimeout;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      checkNavbarFit();
    }, 150);
  });

  // Watch for changes in filters section
  if (filtersSection) {
    const observer = new MutationObserver(function () {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(checkNavbarFit, 100);
    });

    observer.observe(filtersSection, {
      childList: true,
      subtree: true,
      attributes: true,
      attributeFilter: ['class', 'style']
    });
  }
});


// ========== close theme popup ========== 

document.addEventListener('click', function (e) {
  const details = document.querySelectorAll('details');
  details.forEach(detail => {
    if (detail.open && !detail.contains(e.target)) {
      detail.open = false;
    }
  });
});


// ========== filter toggle ========== 

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


// ========== relevance toggle ========== 

const relevanceChevron = document.getElementById('relevance-chevron');
const relevancePopup = document.getElementById('relevance-popup');

relevanceChevron?.addEventListener('click', () => {
  relevancePopup.classList.toggle('hidden');
});


// ========== filter popups toggle ========== 

document.addEventListener('DOMContentLoaded', () => {
  // Get all filter elements
  const filterElements = [
    { btn: 'license-btn', popup: 'license-popup', chevron: 'license-chevron' },
    { btn: 'ai-btn', popup: 'ai-popup', chevron: 'ai-chevron' },
    { btn: 'orientation-btn', popup: 'orientation-popup', chevron: 'orientation-chevron' },
    { btn: 'color-btn', popup: 'color-popup', chevron: 'color-chevron' },
    { btn: 'people-btn', popup: 'people-popup', chevron: 'people-chevron' },
    { btn: 'filetype-btn', popup: 'filetype-popup', chevron: 'filetype-chevron' },
    { btn: 'advanced-btn', popup: 'advanced-popup', chevron: 'advanced-chevron' }
  ];

  // Nested popups inside people filter
  const nestedElements = [
    { btn: 'gender-btn', popup: 'gender-popup', chevron: 'gender-chevron' },
    { btn: 'age-btn', popup: 'age-popup', chevron: 'age-chevron' },
    { btn: 'ethnicity-btn', popup: 'ethnicity-popup', chevron: 'ethnicity-chevron' }
  ];

  // Function to position popup correctly
  function positionPopup(button, popup) {
    const buttonRect = button.getBoundingClientRect();
    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    // Position popup below the button
    popup.style.left = (buttonRect.left + scrollLeft) + 'px';
    popup.style.top = (buttonRect.bottom + scrollTop + 8) + 'px'; // 8px gap
  }

  // Function to close all popups
  function closeAllPopups(except = null) {
    [...filterElements, ...nestedElements].forEach(element => {
      const popup = document.getElementById(element.popup);
      const chevron = document.getElementById(element.chevron);

      if (popup && popup !== except) {
        popup.classList.add('hidden');
        popup.style.display = '';
      }
      if (chevron && chevron !== except) {
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

        // Check if currently open
        const isHidden = popup.classList.contains('hidden');

        // Close all other popups first
        closeAllPopups(popup);

        // Toggle current popup
        if (isHidden) {
          // Position the popup correctly before showing
          positionPopup(btn, popup);
          popup.classList.remove('hidden');
          if (chevron) chevron.classList.add('rotate-180');
          console.log(`Opened ${element.popup}`);
        } else {
          popup.classList.add('hidden');
          if (chevron) chevron.classList.remove('rotate-180');
          console.log(`Closed ${element.popup}`);
        }
      });

      // Prevent popup from closing when clicking inside it
      popup.addEventListener('click', (e) => {
        e.stopPropagation();
      });
    }
  });

  // Add event listeners for nested popups (inside people filter)
  nestedElements.forEach(element => {
    const btn = document.getElementById(element.btn);
    const popup = document.getElementById(element.popup);
    const chevron = document.getElementById(element.chevron);

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();

        // Check if currently open
        const isHidden = popup.classList.contains('hidden');

        // Close other nested popups
        nestedElements.forEach(otherElement => {
          if (otherElement.popup !== element.popup) {
            const otherPopup = document.getElementById(otherElement.popup);
            const otherChevron = document.getElementById(otherElement.chevron);
            if (otherPopup) {
              otherPopup.classList.add('hidden');
              otherPopup.style.display = '';
            }
            if (otherChevron) otherChevron.classList.remove('rotate-180');
          }
        });

        // Toggle current nested popup
        if (isHidden) {
          popup.classList.remove('hidden');
          if (chevron) chevron.classList.add('rotate-180');
          console.log(`Opened nested ${element.popup}`);
        } else {
          popup.classList.add('hidden');
          if (chevron) chevron.classList.remove('rotate-180');
          console.log(`Closed nested ${element.popup}`);
        }
      });

      // Prevent popup from closing when clicking inside it
      popup.addEventListener('click', (e) => {
        e.stopPropagation();
      });
    }
  });

  // Close all popups when clicking outside
  document.addEventListener('click', (e) => {
    const isFilterButton = e.target.closest('[id$="-btn"]') || e.target.closest('[id$="-chevron"]');
    const isInsidePopup = e.target.closest('[id$="-popup"]');

    if (!isFilterButton && !isInsidePopup) {
      closeAllPopups();
    }
  });

  // Reposition popups on scroll or resize
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

  // Initialize all popups as hidden
  [...filterElements, ...nestedElements].forEach(element => {
    const popup = document.getElementById(element.popup);
    if (popup) {
      popup.classList.add('hidden');
      popup.style.display = '';
    }
  });
});

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


// ========== Mobile Sidebar Overlay Functionality ==========
document.addEventListener('DOMContentLoaded', function () {
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');
  const mobileSidebar = document.getElementById('mobile-sidebar');
  const mobileSidebarClose = document.getElementById('mobile-sidebar-close');

  // Open mobile sidebar
  mobileMenuBtn?.addEventListener('click', function () {
    mobileSidebarOverlay.classList.remove('hidden');
    setTimeout(() => {
      mobileSidebar.classList.remove('-translate-x-full');
    }, 10);
  });

  // Close mobile sidebar
  mobileSidebarClose?.addEventListener('click', function () {
    mobileSidebar.classList.add('-translate-x-full');
    setTimeout(() => {
      mobileSidebarOverlay.classList.add('hidden');
    }, 300);
  });

  // Close sidebar when clicking on overlay
  mobileSidebarOverlay?.addEventListener('click', function (e) {
    if (e.target === mobileSidebarOverlay) {
      mobileSidebar.classList.add('-translate-x-full');
      setTimeout(() => {
        mobileSidebarOverlay.classList.add('hidden');
      }, 300);
    }
  });
});


// ========== Mobile 3-Button Navigation ==========
document.addEventListener('DOMContentLoaded', function () {
  const mobileAllImagesBtn = document.getElementById('mobile-all-images-btn');
  const mobileFiltersBtn = document.getElementById('mobile-filters-btn');
  const mobileSettingsBtn = document.getElementById('mobile-settings-btn');

  const mobileAllImagesDropdown = document.getElementById('mobile-all-images-dropdown');
  const mobileFiltersDropdown = document.getElementById('mobile-filters-dropdown');
  const mobileSettingsDropdown = document.getElementById('mobile-settings-dropdown');

  // Function to close all mobile dropdowns
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
  }

  // All Images Button Click
  mobileAllImagesBtn?.addEventListener('click', function (e) {
    e.stopPropagation();

    // Check if currently visible
    const isVisible = mobileAllImagesDropdown.style.display === 'block';

    // Close all dropdowns first
    closeAllMobileDropdowns();

    // Toggle current dropdown
    if (!isVisible) {
      mobileAllImagesDropdown.style.display = 'block';
      mobileAllImagesDropdown.classList.remove('hidden');
      console.log('Opened All Images dropdown');
    }
  });

  // Filters Button Click
  mobileFiltersBtn?.addEventListener('click', function (e) {
    e.stopPropagation();

    // Check if currently visible
    const isVisible = mobileFiltersDropdown.style.display === 'block';

    // Close all dropdowns first
    closeAllMobileDropdowns();

    // Toggle current dropdown
    if (!isVisible) {
      mobileFiltersDropdown.style.display = 'block';
      mobileFiltersDropdown.classList.remove('hidden');
      console.log('Opened Filters dropdown');
    }
  });

  // Settings Button Click
  mobileSettingsBtn?.addEventListener('click', function (e) {
    e.stopPropagation();

    // Check if currently visible
    const isVisible = mobileSettingsDropdown.style.display === 'block';

    // Close all dropdowns first
    closeAllMobileDropdowns();

    // Toggle current dropdown
    if (!isVisible) {
      mobileSettingsDropdown.style.display = 'block';
      mobileSettingsDropdown.classList.remove('hidden');
      console.log('Opened Settings dropdown');
    }
  });

  // Close dropdowns when clicking outside
  document.addEventListener('click', function (e) {
    const isInsideMobileNav = e.target.closest('#mobile-nav-buttons') ||
      e.target.closest('#mobile-all-images-dropdown') ||
      e.target.closest('#mobile-filters-dropdown') ||
      e.target.closest('#mobile-settings-dropdown');

    if (!isInsideMobileNav) {
      closeAllMobileDropdowns();
    }
  });

  // Handle radio button selection and close dropdown
  const radioButtons = document.querySelectorAll('input[name="mobile-navigation"]');
  radioButtons.forEach(radio => {
    radio.addEventListener('change', function () {
      if (this.checked) {
        // Update button text to show selected option
        const selectedText = this.parentElement.querySelector('span').textContent;
        mobileAllImagesBtn.textContent = selectedText;

        // Close dropdown after selection
        setTimeout(() => {
          closeAllMobileDropdowns();
        }, 200);

        console.log('Selected:', selectedText);
      }
    });
  });
});


// ========== Mobile Filter Toggles ==========
document.addEventListener('DOMContentLoaded', function () {
  // Mobile filter elements
  const mobileFilterElements = [
    { btn: 'mobile-license-btn', popup: 'mobile-license-popup' },
    { btn: 'mobile-ai-btn', popup: 'mobile-ai-popup' },
    { btn: 'mobile-orientation-btn', popup: 'mobile-orientation-popup' },
    { btn: 'mobile-color-btn', popup: 'mobile-color-popup' },
    { btn: 'mobile-people-btn', popup: 'mobile-people-popup' },
    { btn: 'mobile-filetype-btn', popup: 'mobile-filetype-popup' },
    { btn: 'mobile-sort-btn', popup: 'mobile-sort-popup' }
  ];

  // Function to close all mobile filter popups
  function closeAllMobileFilterPopups() {
    mobileFilterElements.forEach(element => {
      const popup = document.getElementById(element.popup);
      const btn = document.getElementById(element.btn);
      if (popup) {
        popup.classList.add('hidden');
        popup.style.display = 'none';
      }
      if (btn) {
        const chevron = btn.querySelector('svg');
        if (chevron) chevron.classList.remove('rotate-180');
      }
    });
  }

  // Add event listeners for mobile filter buttons
  mobileFilterElements.forEach(element => {
    const btn = document.getElementById(element.btn);
    const popup = document.getElementById(element.popup);

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();

        // Check if currently open
        const isHidden = popup.classList.contains('hidden');

        // Close all other popups first
        closeAllMobileFilterPopups();

        // Toggle current popup
        if (isHidden) {
          popup.classList.remove('hidden');
          popup.style.display = 'block';
          const chevron = btn.querySelector('svg');
          if (chevron) chevron.classList.add('rotate-180');
          console.log(`Opened mobile ${element.popup}`);
        } else {
          popup.classList.add('hidden');
          popup.style.display = 'none';
          const chevron = btn.querySelector('svg');
          if (chevron) chevron.classList.remove('rotate-180');
          console.log(`Closed mobile ${element.popup}`);
        }
      });

      // Prevent popup from closing when clicking inside it
      popup.addEventListener('click', (e) => {
        e.stopPropagation();
      });
    }
  });

  // Close mobile filter popups when clicking outside
  document.addEventListener('click', (e) => {
    const isInsideMobileFilters = e.target.closest('#mobile-filters-dropdown');
    const isMobileFilterButton = e.target.closest('[id^="mobile-"][id$="-btn"]');

    if (!isInsideMobileFilters && !isMobileFilterButton) {
      closeAllMobileFilterPopups();
    }
  });
});


// ========== Footer Mobile Collapsible Sections ==========
document.addEventListener('DOMContentLoaded', function () {
  // Products Section Toggle
  const productsToggle = document.getElementById('products-toggle');
  const productsList = document.getElementById('products-list');
  const productsArrow = document.getElementById('products-arrow');

  productsToggle?.addEventListener('click', function () {
    productsList.classList.toggle('hidden');
    productsArrow.classList.toggle('rotate-180');
  });

  // Get Started Section Toggle
  const getStartedToggle = document.getElementById('get-started-toggle');
  const getStartedList = document.getElementById('get-started-list');
  const getStartedArrow = document.getElementById('get-started-arrow');

  getStartedToggle?.addEventListener('click', function () {
    getStartedList.classList.toggle('hidden');
    getStartedArrow.classList.toggle('rotate-180');
  });

  // Company Section Toggle
  const companyToggle = document.getElementById('company-toggle');
  const companyList = document.getElementById('company-list');
  const companyArrow = document.getElementById('company-arrow');

  companyToggle?.addEventListener('click', function () {
    companyList.classList.toggle('hidden');
    companyArrow.classList.toggle('rotate-180');
  });
});