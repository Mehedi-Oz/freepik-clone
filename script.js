// ========== Sidebar Collapse Functionality ==========
document.addEventListener('DOMContentLoaded', function () {
  const sidebar = document.getElementById('logo-sidebar');
  const collapseBtn = document.getElementById('sidebar-collapse-btn');
  const mainContent = document.querySelector('.main-wrapper'); // Updated selector
  const sidebarLogo = document.querySelector('.sidebar-logo');
  const sidebarDivider = document.querySelector('.sidebar-divider');
  const headerLogo = document.querySelector('header img');

  let isCollapsed = false;

  function handleResize() {
    const screenWidth = window.innerWidth;

    if (screenWidth < 1280) {
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
      if (collapseBtn) {
        collapseBtn.style.display = 'block';
      }

      if (isCollapsed) {
        isCollapsed = false;
        sidebar.classList.remove('w-16');
        sidebar.classList.add('w-64');
        mainContent.classList.remove('ml-16');
        mainContent.classList.add('ml-64');

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

  window.addEventListener('resize', handleResize);
  handleResize();

  collapseBtn?.addEventListener('click', function () {
    isCollapsed = !isCollapsed;

    if (isCollapsed) {
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

// ========== Search Bar Clear Button Functionality ==========
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.querySelector('input[type="search"]');
  const clearIcon = document.querySelector('.absolute.right-20');
  if (searchInput && clearIcon) {
    function toggleClearButton() {
      if (searchInput.value.trim() !== '') {
        clearIcon.classList.remove('hidden');
      } else {
        clearIcon.classList.add('hidden');
      }
    }

    searchInput.addEventListener('input', toggleClearButton);

    clearIcon.addEventListener('click', function () {
      searchInput.value = '';
      clearIcon.classList.add('hidden');
      searchInput.focus();
    });

    toggleClearButton();
  }
});

// ========== PC Navigation Active State ==========
document.addEventListener('DOMContentLoaded', function () {
  const navItems = document.querySelectorAll('.nav-item');
  const moreBtn = document.getElementById('more-btn');

  navItems.forEach(item => {
    item.addEventListener('click', function () {
      navItems.forEach(nav => nav.classList.remove('active'));
      if (moreBtn) moreBtn.classList.remove('active');
      this.classList.add('active');
      console.log('Selected:', this.textContent.trim());
    });
  });

  if (moreBtn) {
    moreBtn.addEventListener('click', function () {
      navItems.forEach(nav => nav.classList.remove('active'));
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

  function initNavbar() {
    const items = navbarMenu.querySelectorAll('.nav-item:not(#more-btn)');
    allItems = Array.from(items);
    console.log('Found navigation items:', allItems.length);
  }

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

    allItems.forEach((item, index) => {
      if (index < visibleCount) {
        item.classList.remove('hidden');
      } else {
        item.classList.add('hidden');
      }
    });

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

  function updateMoreDropdown(visibleCount) {
    hiddenItems.innerHTML = '';
    hiddenItems.style.display = 'none';

    for (let i = visibleCount; i < allItems.length; i++) {
      const li = document.createElement('li');
      li.className = 'block px-4 py-2 text-white cursor-pointer hover:bg-gray-700 whitespace-nowrap';
      li.textContent = allItems[i].textContent.trim();

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

  document.addEventListener('click', function (e) {
    if (isMoreOpen && !moreBtn.contains(e.target) && !hiddenItems.contains(e.target)) {
      hiddenItems.classList.add('hidden');
      hiddenItems.style.display = 'none';
      isMoreOpen = false;
      console.log('Dropdown closed by outside click');
    }
  });

  setTimeout(() => {
    initNavbar();
    checkNavbarFit();
  }, 300);

  let resizeTimeout;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      checkNavbarFit();
    }, 150);
  });

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

// ========== FIXED filter popups toggle ========== 
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

  // FIXED: Function to position popup correctly using absolute positioning
  function positionPopup(button, popup) {
    // Get the filters section container
    const filtersSection = document.getElementById('filters-section');
    const sectionRect = filtersSection.getBoundingClientRect();
    const buttonRect = button.getBoundingClientRect();
    
    // Calculate position relative to filters section
    const leftOffset = buttonRect.left - sectionRect.left;
    const topOffset = buttonRect.bottom - sectionRect.top + 8; // 8px gap
    
    // Set absolute position relative to filters section
    popup.style.position = 'absolute';
    popup.style.left = leftOffset + 'px';
    popup.style.top = topOffset + 'px';
    popup.style.zIndex = '1000'; // Higher than other elements
    
    // Ensure popup stays within screen bounds
    const popupRect = popup.getBoundingClientRect();
    const viewportWidth = window.innerWidth;
    
    if (popupRect.right > viewportWidth) {
      // Adjust position if popup goes off-screen
      const adjustment = viewportWidth - popupRect.right - 10; // 10px margin
      popup.style.left = (leftOffset + adjustment) + 'px';
    }
    
    console.log(`Positioned ${popup.id} at left: ${leftOffset}px, top: ${topOffset}px`);
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

  // FIXED: Reposition popups on scroll or resize
  function repositionAllPopups() {
    filterElements.forEach(element => {
      const btn = document.getElementById(element.btn);
      const popup = document.getElementById(element.popup);

      if (btn && popup && !popup.classList.contains('hidden')) {
        positionPopup(btn, popup);
      }
    });
  }

  window.addEventListener('scroll', repositionAllPopups);
  window.addEventListener('resize', repositionAllPopups);

  // Initialize all popups as hidden
  [...filterElements, ...nestedElements].forEach(element => {
    const popup = document.getElementById(element.popup);
    if (popup) {
      popup.classList.add('hidden');
      popup.style.display = '';
    }
  });
});

// ========== People Count Button Selection ==========
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

  mobileMenuBtn?.addEventListener('click', function () {
    mobileSidebarOverlay.classList.remove('hidden');
    setTimeout(() => {
      mobileSidebar.classList.remove('-translate-x-full');
    }, 10);
  });

  mobileSidebarClose?.addEventListener('click', function () {
    mobileSidebar.classList.add('-translate-x-full');
    setTimeout(() => {
      mobileSidebarOverlay.classList.add('hidden');
    }, 300);
  });

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

  mobileAllImagesBtn?.addEventListener('click', function (e) {
    e.stopPropagation();
    const isVisible = mobileAllImagesDropdown.style.display === 'block';
    closeAllMobileDropdowns();
    if (!isVisible) {
      mobileAllImagesDropdown.style.display = 'block';
      mobileAllImagesDropdown.classList.remove('hidden');
      console.log('Opened All Images dropdown');
    }
  });

  mobileFiltersBtn?.addEventListener('click', function (e) {
    e.stopPropagation();
    const isVisible = mobileFiltersDropdown.style.display === 'block';
    closeAllMobileDropdowns();
    if (!isVisible) {
      mobileFiltersDropdown.style.display = 'block';
      mobileFiltersDropdown.classList.remove('hidden');
      console.log('Opened Filters dropdown');
    }
  });

  mobileSettingsBtn?.addEventListener('click', function (e) {
    e.stopPropagation();
    const isVisible = mobileSettingsDropdown.style.display === 'block';
    closeAllMobileDropdowns();
    if (!isVisible) {
      mobileSettingsDropdown.style.display = 'block';
      mobileSettingsDropdown.classList.remove('hidden');
      console.log('Opened Settings dropdown');
    }
  });

  document.addEventListener('click', function (e) {
    const isInsideMobileNav = e.target.closest('#mobile-nav-buttons') ||
      e.target.closest('#mobile-all-images-dropdown') ||
      e.target.closest('#mobile-filters-dropdown') ||
      e.target.closest('#mobile-settings-dropdown');

    if (!isInsideMobileNav) {
      closeAllMobileDropdowns();
    }
  });

  const radioButtons = document.querySelectorAll('input[name="mobile-navigation"]');
  radioButtons.forEach(radio => {
    radio.addEventListener('change', function () {
      if (this.checked) {
        const selectedText = this.parentElement.querySelector('span').textContent;
        mobileAllImagesBtn.textContent = selectedText;
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
  const mobileFilterElements = [
    { btn: 'mobile-license-btn', popup: 'mobile-license-popup' },
    { btn: 'mobile-ai-btn', popup: 'mobile-ai-popup' },
    { btn: 'mobile-orientation-btn', popup: 'mobile-orientation-popup' },
    { btn: 'mobile-color-btn', popup: 'mobile-color-popup' },
    { btn: 'mobile-people-btn', popup: 'mobile-people-popup' },
    { btn: 'mobile-filetype-btn', popup: 'mobile-filetype-popup' },
    { btn: 'mobile-sort-btn', popup: 'mobile-sort-popup' }
  ];

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

  mobileFilterElements.forEach(element => {
    const btn = document.getElementById(element.btn);
    const popup = document.getElementById(element.popup);

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = popup.classList.contains('hidden');
        closeAllMobileFilterPopups();

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

      popup.addEventListener('click', (e) => {
        e.stopPropagation();
      });
    }
  });

  document.addEventListener('click', (e) => {
    const isInsideMobileFilters = e.target.closest('#mobile-filters-dropdown');
    const isMobileFilterButton = e.target.closest('[id^="mobile-"][id$="-btn"]');

    if (!isInsideMobileFilters && !isMobileFilterButton) {
      closeAllMobileFilterPopups();
    }
  });
});

// ========== Mobile People Filter Selection ==========
document.addEventListener('DOMContentLoaded', function () {
  const mobileNoPeopleBtn = document.querySelector('.mobile-no-people-btn');
  const mobilePeopleCountBtns = document.querySelectorAll('.mobile-people-count-btn');

  mobileNoPeopleBtn?.addEventListener('click', function () {
    mobilePeopleCountBtns.forEach(btn => btn.classList.remove('bg-green-600'));
    mobileNoPeopleBtn.classList.remove('bg-green-600');
    this.classList.add('bg-green-600');
    console.log('Selected: No people');
  });

  mobilePeopleCountBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      mobilePeopleCountBtns.forEach(b => b.classList.remove('bg-green-600'));
      mobileNoPeopleBtn.classList.remove('bg-green-600');
      this.classList.add('bg-green-600');
      console.log('Selected:', this.textContent, 'people');
    });
  });
});

// ========== Footer Mobile Collapsible Sections ==========
document.addEventListener('DOMContentLoaded', function () {
  const productsToggle = document.getElementById('products-toggle');
  const productsList = document.getElementById('products-list');
  const productsArrow = document.getElementById('products-arrow');

  productsToggle?.addEventListener('click', function () {
    productsList.classList.toggle('hidden');
    productsArrow.classList.toggle('rotate-180');
  });

  const getStartedToggle = document.getElementById('get-started-toggle');
  const getStartedList = document.getElementById('get-started-list');
  const getStartedArrow = document.getElementById('get-started-arrow');

  getStartedToggle?.addEventListener('click', function () {
    getStartedList.classList.toggle('hidden');
    getStartedArrow.classList.toggle('rotate-180');
  });

  const companyToggle = document.getElementById('company-toggle');
  const companyList = document.getElementById('company-list');
  const companyArrow = document.getElementById('company-arrow');

  companyToggle?.addEventListener('click', function () {
    companyList.classList.toggle('hidden');
    companyArrow.classList.toggle('rotate-180');
  });
});