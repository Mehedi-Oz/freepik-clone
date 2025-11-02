// Sidebar collapse/expand logic for desktop and mobile
document.addEventListener('DOMContentLoaded', function () {
  const sidebar = document.getElementById('logo-sidebar');
  const collapseBtn = document.getElementById('sidebar-collapse-btn');
  const mainContent = document.querySelector('.ml-64');
  const sidebarLogo = document.querySelector('.sidebar-logo');
  const sidebarDivider = document.querySelector('.sidebar-divider');
  const headerLogo = document.querySelector('header img');

  // Load saved state from localStorage, default to false
  let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

  // Handles sidebar state based on window width
  function handleResize() {
    const screenWidth = window.innerWidth;

    if (screenWidth < 1280) {
      // Collapse sidebar automatically on small screens
      if (collapseBtn) {
        collapseBtn.style.display = 'none';
      }

      if (!isCollapsed) {
        isCollapsed = true;
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-16');
        mainContent.classList.remove('ml-64');
        mainContent.classList.add('ml-16');

        if (headerLogo) {
          headerLogo.classList.remove('hidden');
        }

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
      // Expand sidebar and show collapse button on large screens
      if (collapseBtn) {
        collapseBtn.style.display = 'block';
      }

      // Apply saved collapse state only on desktop
      if (isCollapsed) {
        applySidebarCollapse();
      } else {
        applySidebarExpand();
      }
    }
  }

  // Apply collapsed sidebar styles
  function applySidebarCollapse() {
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
    const collapseIcon = collapseBtn.querySelector('svg');
    collapseIcon.classList.add('-rotate-90');
    document.querySelector('.sidebar-helper-icons .flex').classList.remove('justify-between');
    document.querySelector('.sidebar-helper-icons .flex').classList.add('justify-center');
    document.querySelector('.sidebar-helper-icons .flex > div').classList.remove('flex', 'gap-4');
    document.querySelector('.sidebar-helper-icons .flex > div').classList.add('flex-col', 'gap-2');
    document.querySelector('.sidebar-helper-icons .flex > div').children[1].classList.add('hidden');
  }

  // Apply expanded sidebar styles
  function applySidebarExpand() {
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

  // Listen for window resize and initialize sidebar state
  window.addEventListener('resize', handleResize);
  handleResize();

  // Manual collapse/expand button for sidebar
  collapseBtn?.addEventListener('click', function () {
    isCollapsed = !isCollapsed;
    // Save state to localStorage
    localStorage.setItem('sidebarCollapsed', isCollapsed);

    if (isCollapsed) {
      applySidebarCollapse();
    } else {
      applySidebarExpand();
    }
  });
});


// Search bar clear button logic: show/hide clear icon and clear input
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.querySelector('input[type="search"]');
  const clearIcon = document.querySelector('.absolute.right-20');

  if (searchInput && clearIcon) {
    // Show/hide clear icon based on input value
    function toggleClearButton() {
      if (searchInput.value.trim() !== '') {
        clearIcon.classList.remove('hidden');
      } else {
        clearIcon.classList.add('hidden');
      }
    }

    // Listen for input changes
    searchInput.addEventListener('input', toggleClearButton);
    // Clear input and hide icon when clear button is clicked
    clearIcon.addEventListener('click', function () {
      searchInput.value = '';
      toggleClearButton();
      searchInput.focus();
    });

    // Set initial icon state
    toggleClearButton();
  }
});


// Handles desktop navigation active state (underline effect)
document.addEventListener('DOMContentLoaded', function () {
  const navItems = document.querySelectorAll('.nav-item');
  const moreBtn = document.getElementById('more-btn');

  // Set active class on clicked navigation item
  navItems.forEach(item => {
    item.addEventListener('click', function () {
      navItems.forEach(nav => nav.classList.remove('active'));
      if (moreBtn) moreBtn.classList.remove('active');
      this.classList.add('active');
    });
  });

  // Set active class on "More" button when clicked
  if (moreBtn) {
    moreBtn.addEventListener('click', function () {
      navItems.forEach(nav => nav.classList.remove('active'));
      this.classList.add('active');
    });
  }

  // Default: first nav item is active
  const defaultItem = document.querySelector('.nav-item');
  if (defaultItem) {
    defaultItem.classList.add('active');
  }
});


// Responsive "More" button for navigation (keeps nav items accessible on small widths)
document.addEventListener('DOMContentLoaded', function () {
  // Elements used by the logic
  const navbarContainer = document.querySelector('nav .flex.justify-between.items-center');
  const navbarMenu = document.getElementById('navbar-menu');
  const moreBtn = document.getElementById('more-btn');
  const hiddenItems = document.getElementById('hidden-items');
  const rightSection = navbarContainer.querySelector('ul:last-child');
  const filtersSection = document.getElementById('filters-section');
  let allItems = [];
  let isMoreOpen = false;

  // Build the list of nav items
  function initNavbar() {
    const items = navbarMenu.querySelectorAll('.nav-item:not(#more-btn)');
    allItems = Array.from(items);
  }

  // Calculate available space and hide overflow items into "More"
  function checkNavbarFit() {
    if (allItems.length === 0) return;

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

    // Show/hide items based on computed visibleCount
    allItems.forEach((item, index) => {
      item.classList.toggle('hidden', index >= visibleCount);
    });

    // Toggle More button and populate its dropdown if needed
    if (visibleCount < allItems.length) {
      moreBtn.classList.remove('hidden');
      updateMoreDropdown(visibleCount);
    } else {
      moreBtn.classList.add('hidden');
      hiddenItems.innerHTML = '';
      hiddenItems.classList.add('hidden');
      isMoreOpen = false;
    }
  }

  // Fill the More dropdown with hidden items
  function updateMoreDropdown(visibleCount) {
    hiddenItems.innerHTML = '';

    for (let i = visibleCount; i < allItems.length; i++) {
      const li = document.createElement('li');
      li.className = 'block px-4 py-2 text-white cursor-pointer hover:bg-gray-700 whitespace-nowrap';
      li.textContent = allItems[i].textContent.trim();
      li.addEventListener('click', (e) => {
        e.stopPropagation();
        hiddenItems.classList.add('hidden');
        isMoreOpen = false;
      });
      hiddenItems.appendChild(li);
    }

    // Close dropdown after updating
    hiddenItems.classList.add('hidden');
    isMoreOpen = false;
  }

  // Toggle More dropdown open/close
  moreBtn.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    isMoreOpen = !isMoreOpen;

    if (isMoreOpen) {
      hiddenItems.classList.remove('hidden');
    } else {
      hiddenItems.classList.add('hidden');
    }
  });

  // Close More when clicking outside
  document.addEventListener('click', function (e) {
    if (isMoreOpen && !moreBtn.contains(e.target) && !hiddenItems.contains(e.target)) {
      hiddenItems.classList.add('hidden');
      isMoreOpen = false;
    }
  });

  // Initial run (delay to allow rendering), plus responsive handlers
  setTimeout(() => {
    initNavbar();
    checkNavbarFit();
  }, 300);

  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(checkNavbarFit, 150);
  });

  // Recalculate when filter area changes
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

// Closes any open <details> elements (like the theme switcher) when a click
document.addEventListener('click', function (e) {
  const details = document.querySelectorAll('details');
  details.forEach(detail => {
    if (detail.open && !detail.contains(e.target)) {
      detail.open = false;
    }
  });
});

// Toggles the visibility of the main filter bar on desktop view

const chevron = document.querySelector('.chevron');
const filtersButton = chevron?.closest('button');
const target = document.getElementById('filters-section');
let isDown = false;

filtersButton?.addEventListener('click', () => {
  chevron.innerHTML = isDown
    ? `<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />`
    : `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />`;
  isDown = !isDown;
  if (target) {
    target.style.display = target.style.display === 'none' ? 'flex' : 'none';
  }
});


// Manages desktop filter popups
document.addEventListener('DOMContentLoaded', () => {
  // main popup configs
  const filterElements = [
    { btn: 'license-btn', popup: 'license-popup', chevron: 'license-chevron' },
    { btn: 'ai-btn', popup: 'ai-popup', chevron: 'ai-chevron' },
    { btn: 'orientation-btn', popup: 'orientation-popup', chevron: 'orientation-chevron' },
    { btn: 'color-btn', popup: 'color-popup', chevron: 'color-chevron' },
    { btn: 'people-btn', popup: 'people-popup', chevron: 'people-chevron' },
    { btn: 'filetype-btn', popup: 'filetype-popup', chevron: 'filetype-chevron' },
    { btn: 'advanced-btn', popup: 'advanced-popup', chevron: 'advanced-chevron' }
  ];

  // nested popup configs
  const nestedElements = [
    { btn: 'gender-btn', popup: 'gender-popup', chevron: 'gender-chevron' },
    { btn: 'age-btn', popup: 'age-popup', chevron: 'age-chevron' },
    { btn: 'ethnicity-btn', popup: 'ethnicity-popup', chevron: 'ethnicity-chevron' }
  ];

  // position popup below its trigger
  function positionPopup(button, popup) {
    const buttonRect = button.getBoundingClientRect();
    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
    popup.style.left = (buttonRect.left + scrollLeft) + 'px';
    popup.style.top = (buttonRect.bottom + 8) + 'px';
  }

  // hide all popups except optional one
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

    // Also close relevance popup
    const relevancePopup = document.getElementById('relevance-popup');
    const relevanceChevron = document.getElementById('relevance-chevron');
    if (relevancePopup && relevancePopup !== except) {
      relevancePopup.classList.add('hidden');
    }
    if (relevanceChevron) {
      relevanceChevron.classList.remove('rotate-180');
    }
  }

  // main filter button listeners
  filterElements.forEach(element => {
    const btn = document.getElementById(element.btn);
    const popup = document.getElementById(element.popup);
    const chevron = document.getElementById(element.chevron);

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = popup.classList.contains('hidden');

        if (isHidden) {
          closeAllPopups(popup);
          positionPopup(btn, popup);
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

  // Relevance popup handler
const relevanceChevron = document.getElementById('relevance-chevron');
const relevancePopup = document.getElementById('relevance-popup');
const relevanceButton = relevanceChevron?.closest('button');

if (relevanceButton && relevancePopup) {
  relevanceButton.addEventListener('click', (e) => {
    e.stopPropagation();
    const isHidden = relevancePopup.classList.contains('hidden');

    if (isHidden) {
      closeAllPopups(relevancePopup);
      relevancePopup.classList.remove('hidden');
      relevanceChevron.classList.add('rotate-180');
    } else {
      relevancePopup.classList.add('hidden');
      relevanceChevron.classList.remove('rotate-180');
    }
  });
  relevancePopup.addEventListener('click', (e) => e.stopPropagation());
}

  // nested filter button listeners
  nestedElements.forEach(element => {
    const btn = document.getElementById(element.btn);
    const popup = document.getElementById(element.popup);
    const chevron = document.getElementById(element.chevron);

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = popup.classList.contains('hidden');
        // close other nested popups
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

  // close popups when clicking outside
  document.addEventListener('click', (e) => {
    const isInsideFilter = e.target.closest('[id$="-btn"], [id$="-chevron"], [id$="-popup"]');
    const isInsideRelevance = e.target.closest('#relevance-chevron, #relevance-popup') || e.target.closest('li:has(#relevance-chevron)');
    if (!isInsideFilter && !isInsideRelevance) {
      closeAllPopups();
    }
  });

  // reposition visible popups on scroll/resize
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

  // ensure all popups start hidden
  [...filterElements, ...nestedElements].forEach(element => {
    const popup = document.getElementById(element.popup);
    if (popup) {
      popup.classList.add('hidden');
      popup.style.display = '';
    }
  });

  // ensure relevance popup starts hidden
  if (relevancePopup) {
    relevancePopup.classList.add('hidden');
  }
});

// People count group: set clicked button as active
document.querySelectorAll('.people-count-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.people-count-btn').forEach(b => b.classList.remove('bg-green-600'));
    this.classList.add('bg-green-600');
  });
});

// Author mode group: set clicked button as active
document.querySelectorAll('.author-mode-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.author-mode-btn').forEach(b => b.classList.remove('bg-green-600'));
    this.classList.add('bg-green-600');
  });
});

// Result variety group: set clicked button as active
document.querySelectorAll('.result-variety-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.result-variety-btn').forEach(b => b.classList.remove('bg-green-600'));
    this.classList.add('bg-green-600');
  });
});


// Mobile menu and overlay handlers
document.addEventListener('DOMContentLoaded', function () {
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');
  const mobileSidebar = document.getElementById('mobile-sidebar');
  const mobileSidebarClose = document.getElementById('mobile-sidebar-close');

  // show overlay and slide sidebar in
  mobileMenuBtn?.addEventListener('click', function () {
    mobileSidebarOverlay.classList.remove('hidden');
    setTimeout(() => mobileSidebar.classList.remove('-translate-x-full'), 10);
  });

  // slide sidebar out and hide overlay
  mobileSidebarClose?.addEventListener('click', function () {
    mobileSidebar.classList.add('-translate-x-full');
    setTimeout(() => mobileSidebarOverlay.classList.add('hidden'), 300);
  });

  // close when clicking outside the sidebar
  mobileSidebarOverlay?.addEventListener('click', function (e) {
    if (e.target === mobileSidebarOverlay) {
      mobileSidebar.classList.add('-translate-x-full');
      setTimeout(() => mobileSidebarOverlay.classList.add('hidden'), 300);
    }
  });
});


// Mobile dropdown handlers and body scroll lock
document.addEventListener('DOMContentLoaded', function () {
  const mobileAllImagesBtn = document.getElementById('mobile-all-images-btn');
  const mobileFiltersBtn = document.getElementById('mobile-filters-btn');
  const mobileSettingsBtn = document.getElementById('mobile-settings-btn');

  const mobileAllImagesDropdown = document.getElementById('mobile-all-images-dropdown');
  const mobileFiltersDropdown = document.getElementById('mobile-filters-dropdown');
  const mobileSettingsDropdown = document.getElementById('mobile-settings-dropdown');

  // Hide all mobile dropdowns and remove scroll-lock class
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
    document.body.classList.remove('no-scroll');
  }

  // Toggle a single dropdown and toggle body scroll-lock
  function handleDropdownClick(dropdown) {
    const isVisible = dropdown.style.display === 'block';
    closeAllMobileDropdowns();
    if (!isVisible) {
      dropdown.style.display = 'block';
      dropdown.classList.remove('hidden');
      document.body.classList.add('no-scroll');
    }
  }

  // Button listeners to open respective dropdowns
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

  // Close dropdowns when clicking outside the mobile nav area
  document.addEventListener('click', function (e) {
    const isInsideNav = e.target.closest('#mobile-nav-buttons, #mobile-all-images-dropdown, #mobile-filters-dropdown, #mobile-settings-dropdown');
    if (!isInsideNav) {
      closeAllMobileDropdowns();
    }
  });

  // Update the All Images button label when a radio option is selected
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


// Manage individual filter popups on mobile
document.addEventListener('DOMContentLoaded', function () {
  // mapping of mobile filter buttons to their popups
  const mobileFilterElements = [
    { btn: 'mobile-license-btn', popup: 'mobile-license-popup' },
    { btn: 'mobile-ai-btn', popup: 'mobile-ai-popup' },
    { btn: 'mobile-orientation-btn', popup: 'mobile-orientation-popup' },
    { btn: 'mobile-color-btn', popup: 'mobile-color-popup' },
    { btn: 'mobile-people-btn', popup: 'mobile-people-popup' },
    { btn: 'mobile-filetype-btn', popup: 'mobile-filetype-popup' },
    { btn: 'mobile-sort-btn', popup: 'mobile-sort-popup' }
  ];

  // hide all mobile filter popups and reset chevrons
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

  // attach click handlers to each filter button and its popup
  mobileFilterElements.forEach(element => {
    const btn = document.getElementById(element.btn);
    const popup = document.getElementById(element.popup);

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = popup.classList.contains('hidden');
        closeAllMobileFilterPopups(); // ensure only one open at a time
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


// Manages the collapsible accordion sections in the footer for mobile view
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


// Adds interactive overlays and actions to image cards
document.addEventListener('DOMContentLoaded', function () {

  // SVG templates for overlay buttons
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

  // Build overlay HTML for a card
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

  // Initialize overlays and wire action buttons on all image cards
  function initializeImageCards() {
    const imageCards = document.querySelectorAll('.image-card');

    imageCards.forEach(card => {
      card.innerHTML += createImageOverlay();

      const downloadBtn = card.querySelector('.download-btn');
      const editBtn = card.querySelector('.edit-btn');
      const saveBtn = card.querySelector('.save-btn');
      const discoverBtn = card.querySelector('.discover-btn');

      const imageId = card.dataset.image;
      const imageAlt = card.querySelector('img').alt;

      downloadBtn.addEventListener('click', (e) => {
        e.preventDefault();
        handleImageAction('download', imageId, imageAlt);
      });

      editBtn.addEventListener('click', (e) => {
        e.preventDefault();
        handleImageAction('edit', imageId, imageAlt);
      });

      saveBtn.addEventListener('click', (e) => {
        e.preventDefault();
        handleImageAction('save', imageId, imageAlt);
      });

      discoverBtn.addEventListener('click', (e) => {
        e.preventDefault();
        handleImageAction('discover', imageId, imageAlt);
      });
    });
  }

  // Perform the requested action for an image
  function handleImageAction(action, imageId, imageAlt) {
    switch (action) {
      case 'download':
        console.log(`Downloading image ${imageId}: ${imageAlt}`);
        downloadImage(imageId);
        break;

      case 'edit':
        console.log(`Editing image ${imageId}: ${imageAlt}`);
        openImageEditor(imageId);
        break;

      case 'save':
        console.log(`Saving image ${imageId}: ${imageAlt}`);
        saveToCollection(imageId);
        showNotification('Image saved to collection!');
        break;

      case 'discover':
        console.log(`Finding similar images to ${imageId}: ${imageAlt}`);
        findSimilarImages(imageId);
        break;

      default:
        console.log('Unknown action:', action);
    }
  }

  // Start the image card system
  initializeImageCards();
});


// Suggested search tags navigation
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.querySelector('input[type="search"]');
  const searchTags = document.querySelectorAll('.overflow-x-auto ul li');

  searchTags.forEach(tag => {
    tag.addEventListener('click', function () {
      const tagText = this.textContent.trim();

      // Update search input with clicked tag
      if (searchInput) {
        searchInput.value = tagText;
      }

      // Scroll to top of page
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });

      // Optional: You can trigger a search or filter action here
      console.log(`Searching for: ${tagText}`);

      // Add visual feedback
      searchTags.forEach(t => t.classList.remove('bg-gray-600'));
      this.classList.add('bg-gray-600');
    });
  });
});


// Suggested search tags navigation with arrow controls
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.querySelector('input[type="search"]');
  const searchTags = document.querySelectorAll('.overflow-x-auto ul li');
  const tagsContainer = document.getElementById('tags-container');
  const scrollLeftBtn = document.getElementById('tags-scroll-left');
  const scrollRightBtn = document.getElementById('tags-scroll-right');

  // Handle tag clicks
  searchTags.forEach(tag => {
    tag.addEventListener('click', function () {
      const tagText = this.textContent.trim();

      // Update search input with clicked tag
      if (searchInput) {
        searchInput.value = tagText;
      }

      // Scroll to top of page
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });

      console.log(`Searching for: ${tagText}`);

      // Add visual feedback
      searchTags.forEach(t => t.classList.remove('bg-gray-600'));
      this.classList.add('bg-gray-600');
    });
  });

  // Arrow navigation functionality
  if (tagsContainer && scrollLeftBtn && scrollRightBtn) {
    const scrollAmount = 300; // pixels to scroll per click

    // Update arrow visibility based on scroll position
    function updateArrows() {
      const { scrollLeft, scrollWidth, clientWidth } = tagsContainer;

      // Show/hide left arrow
      if (scrollLeft > 0) {
        scrollLeftBtn.classList.remove('hidden');
      } else {
        scrollLeftBtn.classList.add('hidden');
      }

      // Show/hide right arrow
      if (scrollLeft + clientWidth < scrollWidth - 10) {
        scrollRightBtn.classList.remove('hidden');
      } else {
        scrollRightBtn.classList.add('hidden');
      }
    }

    // Scroll left
    scrollLeftBtn.addEventListener('click', () => {
      tagsContainer.scrollBy({
        left: -scrollAmount,
        behavior: 'smooth'
      });
    });

    // Scroll right
    scrollRightBtn.addEventListener('click', () => {
      tagsContainer.scrollBy({
        left: scrollAmount,
        behavior: 'smooth'
      });
    });

    // Listen for scroll events to update arrows
    tagsContainer.addEventListener('scroll', updateArrows);

    // Initial arrow state check
    updateArrows();

    // Re-check on window resize
    window.addEventListener('resize', updateArrows);
  }
});


// More options popup handler for sidebar
document.addEventListener('DOMContentLoaded', function () {
  const moreOptionsBtn = document.getElementById('more-options-btn');
  const moreOptionsPopup = document.getElementById('more-options-popup');
  const collapsedFooterIcons = document.getElementById('collapsed-footer-icons');
  const sidebarFooterIcons = document.querySelector('.sidebar-helper-icons');
  const sidebar = document.getElementById('logo-sidebar');

  if (moreOptionsBtn && moreOptionsPopup) {
    // Toggle popup on button click
    moreOptionsBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      moreOptionsPopup.classList.toggle('hidden');

      // Show/hide the collapsed footer icons based on sidebar state
      if (!moreOptionsPopup.classList.contains('hidden') && sidebar.classList.contains('w-16')) {
        collapsedFooterIcons.classList.remove('hidden');
      } else {
        collapsedFooterIcons.classList.add('hidden');
      }
    });

    // Close popup when clicking outside
    document.addEventListener('click', function (e) {
      if (!moreOptionsBtn.contains(e.target) && !moreOptionsPopup.contains(e.target)) {
        moreOptionsPopup.classList.add('hidden');
        collapsedFooterIcons.classList.add('hidden');
      }
    });

    // Close popup when clicking a link inside
    moreOptionsPopup.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', function () {
        moreOptionsPopup.classList.add('hidden');
        collapsedFooterIcons.classList.add('hidden');
      });
    });

    // Add theme switcher functionality for collapsed state
    const collapsedThemeBtn = collapsedFooterIcons?.querySelector('[title="Theme"]');
    if (collapsedThemeBtn) {
      // Create theme popup
      const themePopup = document.createElement('div');
      themePopup.className = 'absolute bottom-full mb-2 w-32 bg-gray-800 border border-gray-600 rounded shadow-lg z-50 text-white text-sm hidden';
      themePopup.innerHTML = `
        <ul class="py-1">
          <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
            </svg>
            Light
          </li>
          <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
            </svg>
            Dark
          </li>
          <li class="flex items-center gap-2 px-4 py-2 hover:bg-gray-700 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
            </svg>
            System
          </li>
        </ul>
      `;

      // Wrap theme button in relative container
      const themeBtnWrapper = document.createElement('div');
      themeBtnWrapper.className = 'relative';
      collapsedThemeBtn.parentNode.insertBefore(themeBtnWrapper, collapsedThemeBtn);
      themeBtnWrapper.appendChild(collapsedThemeBtn);
      themeBtnWrapper.appendChild(themePopup);

      // Toggle theme popup
      collapsedThemeBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        themePopup.classList.toggle('hidden');
      });

      // Close theme popup when clicking outside
      document.addEventListener('click', function(e) {
        if (!themeBtnWrapper.contains(e.target)) {
          themePopup.classList.add('hidden');
        }
      });

      // Handle theme selection
      themePopup.querySelectorAll('li').forEach(item => {
        item.addEventListener('click', function() {
          console.log('Theme selected:', this.textContent.trim());
          themePopup.classList.add('hidden');
        });
      });
    }

    // Monitor sidebar collapse state changes and apply on load
    const observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.attributeName === 'class') {
          const isCollapsed = sidebar.classList.contains('w-16');

          // Hide the help and theme buttons when collapsed (not the entire footer)
          const helperIconsContainer = sidebarFooterIcons.querySelector('.flex > div');
          if (isCollapsed) {
            if (helperIconsContainer) {
              helperIconsContainer.style.display = 'none';
            }
          } else {
            if (helperIconsContainer) {
              helperIconsContainer.style.display = 'flex';
            }
            collapsedFooterIcons.classList.add('hidden');
          }
        }
      });
    });

    observer.observe(sidebar, { attributes: true });

    // Apply initial state on page load
    const isCollapsedOnLoad = sidebar.classList.contains('w-16');
    const helperIconsContainer = sidebarFooterIcons.querySelector('.flex > div');
    if (isCollapsedOnLoad && helperIconsContainer) {
      helperIconsContainer.style.display = 'none';
    }
  }
});


// All Tools popup handler for sidebar
document.addEventListener('DOMContentLoaded', function () {
  const allToolsBtn = document.getElementById('all-tools-btn');
  const allToolsPopup = document.getElementById('all-tools-popup');
  const allToolsListItem = allToolsBtn?.closest('li');

  if (allToolsBtn && allToolsPopup && allToolsListItem) {
    // Toggle popup on button click
    allToolsBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      allToolsPopup.classList.toggle('hidden');
    });

    // Close popup when clicking outside
    document.addEventListener('click', function (e) {
      if (!allToolsBtn.contains(e.target) && !allToolsPopup.contains(e.target)) {
        allToolsPopup.classList.add('hidden');
      }
    });

    // Close popup when clicking a link inside
    allToolsPopup.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', function () {
        allToolsPopup.classList.add('hidden');
      });
    });

    // Prevent popup from closing when clicking inside it
    allToolsPopup.addEventListener('click', function (e) {
      e.stopPropagation();
    });
  }
});