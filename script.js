// Sidebar collapse/expand
document.addEventListener('DOMContentLoaded', function () {
  const sidebar = document.getElementById('logo-sidebar');
  const collapseBtn = document.getElementById('sidebar-collapse-btn');
  const mainContent = document.querySelector('.ml-64');
  const sidebarLogo = document.querySelector('.sidebar-logo');
  const sidebarDivider = document.querySelector('.sidebar-divider');
  const headerLogo = document.querySelector('header img');

  let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

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

        sidebarLogo.classList.remove('justify-between');
        sidebarLogo.classList.add('justify-center');
        document.querySelectorAll('.sidebar-text').forEach(text => {
          text.classList.add('hidden');
        });
        document.getElementById('sidebar-logo-img').classList.add('hidden');
        sidebarDivider.classList.remove('mx');
        sidebarDivider.classList.add('mx-2');
        document.querySelector('.sidebar-signin').classList.add('hidden');

        document.querySelectorAll('#logo-sidebar .sidebar-menu a').forEach(link => {
          link.classList.remove('p-2');
          link.classList.add('p-1', 'justify-center');
        });
        document.querySelectorAll('#logo-sidebar .sidebar-menu svg').forEach(svg => {
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
        applySidebarCollapse();
      } else {
        applySidebarExpand();
      }
    }
  }

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

    document.querySelectorAll('#logo-sidebar .sidebar-menu a').forEach(link => {
      link.classList.remove('p-2');
      link.classList.add('p-1', 'justify-center');
    });
    document.querySelectorAll('#logo-sidebar .sidebar-menu svg').forEach(svg => {
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

    document.querySelectorAll('#logo-sidebar .sidebar-menu a').forEach(link => {
      link.classList.add('p-2');
      link.classList.remove('p-1', 'justify-center');
    });
    document.querySelectorAll('#logo-sidebar .sidebar-menu svg').forEach(svg => {
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

  window.addEventListener('resize', handleResize);
  handleResize();

  collapseBtn?.addEventListener('click', function () {
    isCollapsed = !isCollapsed;
    localStorage.setItem('sidebarCollapsed', isCollapsed);

    if (isCollapsed) {
      applySidebarCollapse();
    } else {
      applySidebarExpand();
    }
  });
});


// Search bar clear button
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
      toggleClearButton();
      searchInput.focus();
    });

    toggleClearButton();
  }
});


// Desktop navigation active state
document.addEventListener('DOMContentLoaded', function () {
  const navItems = document.querySelectorAll('.nav-item');
  const moreBtn = document.getElementById('more-btn');

  navItems.forEach(item => {
    item.addEventListener('click', function () {
      navItems.forEach(nav => nav.classList.remove('active'));
      if (moreBtn) moreBtn.classList.remove('active');
      this.classList.add('active');
    });
  });

  if (moreBtn) {
    moreBtn.addEventListener('click', function () {
      navItems.forEach(nav => nav.classList.remove('active'));
      this.classList.add('active');
    });
  }

  const defaultItem = document.querySelector('.nav-item');
  if (defaultItem) {
    defaultItem.classList.add('active');
  }
});


// Responsive "More" button for navigation
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
  }

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

    allItems.forEach((item, index) => {
      item.classList.toggle('hidden', index >= visibleCount);
    });

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

    hiddenItems.classList.add('hidden');
    isMoreOpen = false;
  }

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

  document.addEventListener('click', function (e) {
    if (isMoreOpen && !moreBtn.contains(e.target) && !hiddenItems.contains(e.target)) {
      hiddenItems.classList.add('hidden');
      isMoreOpen = false;
    }
  });

  setTimeout(() => {
    initNavbar();
    checkNavbarFit();
  }, 300);

  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(checkNavbarFit, 150);
  });

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

// Close <details> elements when clicking outside
document.addEventListener('click', function (e) {
  const details = document.querySelectorAll('details');
  details.forEach(detail => {
    if (detail.open && !detail.contains(e.target)) {
      detail.open = false;
    }
  });
});

// Filter bar toggle
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


// Desktop filter popups
document.addEventListener('DOMContentLoaded', () => {
  const filterElements = [
    { btn: 'license-btn', popup: 'license-popup', chevron: 'license-chevron' },
    { btn: 'ai-btn', popup: 'ai-popup', chevron: 'ai-chevron' },
    { btn: 'orientation-btn', popup: 'orientation-popup', chevron: 'orientation-chevron' },
    { btn: 'color-btn', popup: 'color-popup', chevron: 'color-chevron' },
    { btn: 'people-btn', popup: 'people-popup', chevron: 'people-chevron' },
    { btn: 'filetype-btn', popup: 'filetype-popup', chevron: 'filetype-chevron' },
    { btn: 'advanced-btn', popup: 'advanced-popup', chevron: 'advanced-chevron' }
  ];

  const nestedElements = [
    { btn: 'gender-btn', popup: 'gender-popup', chevron: 'gender-chevron' },
    { btn: 'age-btn', popup: 'age-popup', chevron: 'age-chevron' },
    { btn: 'ethnicity-btn', popup: 'ethnicity-popup', chevron: 'ethnicity-chevron' }
  ];

  function positionPopup(button, popup) {
    const buttonRect = button.getBoundingClientRect();
    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
    popup.style.left = (buttonRect.left + scrollLeft) + 'px';
    popup.style.top = (buttonRect.bottom + 8) + 'px';
  }

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

    const relevancePopup = document.getElementById('relevance-popup');
    const relevanceChevron = document.getElementById('relevance-chevron');
    if (relevancePopup && relevancePopup !== except) {
      relevancePopup.classList.add('hidden');
    }
    if (relevanceChevron) {
      relevanceChevron.classList.remove('rotate-180');
    }
  }

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

  nestedElements.forEach(element => {
    const btn = document.getElementById(element.btn);
    const popup = document.getElementById(element.popup);
    const chevron = document.getElementById(element.chevron);

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = popup.classList.contains('hidden');
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

  document.addEventListener('click', (e) => {
    const isInsideFilter = e.target.closest('[id$="-btn"], [id$="-chevron"], [id$="-popup"]');
    const isInsideRelevance = e.target.closest('#relevance-chevron, #relevance-popup') || e.target.closest('li:has(#relevance-chevron)');
    if (!isInsideFilter && !isInsideRelevance) {
      closeAllPopups();
    }
  });

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

  [...filterElements, ...nestedElements].forEach(element => {
    const popup = document.getElementById(element.popup);
    if (popup) {
      popup.classList.add('hidden');
      popup.style.display = '';
    }
  });

  if (relevancePopup) {
    relevancePopup.classList.add('hidden');
  }
});

// Button group toggles
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


// Mobile sidebar
document.addEventListener('DOMContentLoaded', function () {
  const mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');
  const mobileSidebar = document.getElementById('mobile-sidebar');
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileSidebarClose = document.getElementById('mobile-sidebar-close');

  mobileMenuBtn?.addEventListener('click', function () {
    mobileSidebarOverlay.classList.remove('hidden');
    mobileSidebar.classList.remove('-translate-x-full');
    document.body.classList.add('overflow-hidden');
  });

  mobileSidebarClose?.addEventListener('click', function () {
    mobileSidebarOverlay.classList.add('hidden');
    mobileSidebar.classList.add('-translate-x-full');
    document.body.classList.remove('overflow-hidden');
  });

  mobileSidebarOverlay?.addEventListener('click', function (e) {
    if (e.target === mobileSidebarOverlay) {
      mobileSidebarOverlay.classList.add('hidden');
      mobileSidebar.classList.add('-translate-x-full');
      document.body.classList.remove('overflow-hidden');
    }
  });
});


// Mobile dropdowns
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
    document.body.classList.remove('no-scroll');
  }

  function handleDropdownClick(dropdown) {
    const isVisible = dropdown.style.display === 'block';
    closeAllMobileDropdowns();
    if (!isVisible) {
      dropdown.style.display = 'block';
      dropdown.classList.remove('hidden');
      document.body.classList.add('no-scroll');
    }
  }

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

  document.addEventListener('click', function (e) {
    const isInsideNav = e.target.closest('#mobile-nav-buttons, #mobile-all-images-dropdown, #mobile-filters-dropdown, #mobile-settings-dropdown');
    if (!isInsideNav) {
      closeAllMobileDropdowns();
    }
  });

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


// Mobile filter popups
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
        btn.querySelector('svg')?.classList.remove('rotate-180');
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
          btn.querySelector('svg')?.classList.add('rotate-180');
        }
      });
      popup.addEventListener('click', (e) => e.stopPropagation());
    }
  });
});


// Footer accordion
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


// Image card overlays
document.addEventListener('DOMContentLoaded', function () {

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

  function createImageOverlay() {
    return `
      <div class="overlay absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 rounded-lg"></div>
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
      <div class="discover-section absolute bottom-2 left-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <button class="discover-btn flex items-center gap-2 text-white bg-gray-800 bg-opacity-70 rounded-full px-3 py-1 text-sm hover:bg-opacity-90 transition" data-action="discover">
          ${icons.search}
          Discover similar
        </button>
      </div>
    `;
  }

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

  initializeImageCards();
});


// Search tags navigation
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.querySelector('input[type="search"]');
  const searchTags = document.querySelectorAll('.overflow-x-auto ul li');

  searchTags.forEach(tag => {
    tag.addEventListener('click', function () {
      const tagText = this.textContent.trim();

      if (searchInput) {
        searchInput.value = tagText;
      }

      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });

      console.log(`Searching for: ${tagText}`);

      searchTags.forEach(t => t.classList.remove('bg-gray-600'));
      this.classList.add('bg-gray-600');
    });
  });
});


// Search tags with arrow controls
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.querySelector('input[type="search"]');
  const searchTags = document.querySelectorAll('.overflow-x-auto ul li');
  const tagsContainer = document.getElementById('tags-container');
  const scrollLeftBtn = document.getElementById('tags-scroll-left');
  const scrollRightBtn = document.getElementById('tags-scroll-right');

  searchTags.forEach(tag => {
    tag.addEventListener('click', function () {
      const tagText = this.textContent.trim();

      if (searchInput) {
        searchInput.value = tagText;
      }

      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });

      console.log(`Searching for: ${tagText}`);

      searchTags.forEach(t => t.classList.remove('bg-gray-600'));
      this.classList.add('bg-gray-600');
    });
  });

  if (tagsContainer && scrollLeftBtn && scrollRightBtn) {
    const scrollAmount = 300;

    function updateArrows() {
      const { scrollLeft, scrollWidth, clientWidth } = tagsContainer;

      if (scrollLeft > 0) {
        scrollLeftBtn.classList.remove('hidden');
      } else {
        scrollLeftBtn.classList.add('hidden');
      }

      if (scrollLeft + clientWidth < scrollWidth - 10) {
        scrollRightBtn.classList.remove('hidden');
      } else {
        scrollRightBtn.classList.add('hidden');
      }
    }

    scrollLeftBtn.addEventListener('click', () => {
      tagsContainer.scrollBy({
        left: -scrollAmount,
        behavior: 'smooth'
      });
    });

    scrollRightBtn.addEventListener('click', () => {
      tagsContainer.scrollBy({
        left: scrollAmount,
        behavior: 'smooth'
      });
    });

    tagsContainer.addEventListener('scroll', updateArrows);
    updateArrows();
    window.addEventListener('resize', updateArrows);
  }
});


// Sidebar more options popup
document.addEventListener('DOMContentLoaded', function () {
  const moreOptionsBtn = document.getElementById('more-options-btn');
  const moreOptionsPopup = document.getElementById('more-options-popup');
  const collapsedFooterIcons = document.getElementById('collapsed-footer-icons');
  const sidebarFooterIcons = document.querySelector('.sidebar-helper-icons');
  const sidebar = document.getElementById('logo-sidebar');

  if (moreOptionsBtn && moreOptionsPopup) {
    moreOptionsBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      moreOptionsPopup.classList.toggle('hidden');

      if (!moreOptionsPopup.classList.contains('hidden') && sidebar.classList.contains('w-16')) {
        collapsedFooterIcons.classList.remove('hidden');
      } else {
        collapsedFooterIcons.classList.add('hidden');
      }
    });

    document.addEventListener('click', function (e) {
      if (!moreOptionsBtn.contains(e.target) && !moreOptionsPopup.contains(e.target)) {
        moreOptionsPopup.classList.add('hidden');
        collapsedFooterIcons.classList.add('hidden');
      }
    });

    moreOptionsPopup.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', function () {
        moreOptionsPopup.classList.add('hidden');
        collapsedFooterIcons.classList.add('hidden');
      });
    });

    const collapsedThemeBtn = collapsedFooterIcons?.querySelector('[title="Theme"]');
    if (collapsedThemeBtn) {
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

      const themeBtnWrapper = document.createElement('div');
      themeBtnWrapper.className = 'relative';
      collapsedThemeBtn.parentNode.insertBefore(themeBtnWrapper, collapsedThemeBtn);
      themeBtnWrapper.appendChild(collapsedThemeBtn);
      themeBtnWrapper.appendChild(themePopup);

      collapsedThemeBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        themePopup.classList.toggle('hidden');
      });

      document.addEventListener('click', function (e) {
        if (!themeBtnWrapper.contains(e.target)) {
          themePopup.classList.add('hidden');
        }
      });

      themePopup.querySelectorAll('li').forEach(item => {
        item.addEventListener('click', function () {
          console.log('Theme selected:', this.textContent.trim());
          themePopup.classList.add('hidden');
        });
      });
    }

    const observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        if (mutation.attributeName === 'class') {
          const isCollapsed = sidebar.classList.contains('w-16');
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

    const isCollapsedOnLoad = sidebar.classList.contains('w-16');
    const helperIconsContainer = sidebarFooterIcons.querySelector('.flex > div');
    if (isCollapsedOnLoad && helperIconsContainer) {
      helperIconsContainer.style.display = 'none';
    }
  }
});


// All Tools popup
document.addEventListener('DOMContentLoaded', function () {
  const allToolsBtn = document.getElementById('all-tools-btn');
  const allToolsPopup = document.getElementById('all-tools-popup');
  const allToolsListItem = allToolsBtn?.closest('li');

  if (allToolsBtn && allToolsPopup && allToolsListItem) {
    allToolsBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      allToolsPopup.classList.toggle('hidden');
    });

    document.addEventListener('click', function (e) {
      if (!allToolsBtn.contains(e.target) && !allToolsPopup.contains(e.target)) {
        allToolsPopup.classList.add('hidden');
      }
    });

    allToolsPopup.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', function () {
        allToolsPopup.classList.add('hidden');
      });
    });

    allToolsPopup.addEventListener('click', function (e) {
      e.stopPropagation();
    });
  }
});


// Mobile more options popup
document.addEventListener('DOMContentLoaded', function () {
  const mobileMoreBtn = document.getElementById('mobile-more-options-btn');
  const mobileMorePopup = document.getElementById('mobile-more-options-popup');

  if (mobileMoreBtn && mobileMorePopup) {
    mobileMoreBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      mobileMorePopup.classList.toggle('hidden');
    });

    document.addEventListener('click', function (e) {
      if (!mobileMoreBtn.contains(e.target) && !mobileMorePopup.contains(e.target)) {
        mobileMorePopup.classList.add('hidden');
      }
    });

    mobileMorePopup.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', function () {
        mobileMorePopup.classList.add('hidden');
      });
    });

    mobileMorePopup.addEventListener('click', function (e) {
      e.stopPropagation();
    });
  }
});


// Mobile All Tools page
document.addEventListener('DOMContentLoaded', function () {
  const mobileAllToolsBtn = document.querySelector('#mobile-sidebar ul:nth-of-type(2) li:nth-child(4) a');
  const mobileAllToolsPage = document.getElementById('mobile-all-tools-page');
  const mobileAllToolsBack = document.getElementById('mobile-all-tools-back');
  const mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');
  const mobileSidebar = document.getElementById('mobile-sidebar');

  if (mobileAllToolsBtn && mobileAllToolsPage) {
    mobileAllToolsBtn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();

      mobileSidebarOverlay.classList.add('hidden');
      mobileSidebar.classList.add('-translate-x-full');
      document.body.classList.remove('overflow-hidden');

      mobileAllToolsPage.classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    });

    mobileAllToolsBack?.addEventListener('click', function (e) {
      e.preventDefault();

      mobileAllToolsPage.classList.add('hidden');

      mobileSidebarOverlay.classList.remove('hidden');
      mobileSidebar.classList.remove('-translate-x-full');
      document.body.classList.add('overflow-hidden');
    });

    mobileAllToolsPage.querySelectorAll('a:not(#mobile-all-tools-back)').forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        mobileAllToolsPage.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      });
    });
  } else {
    console.error('Elements not found:', {
      mobileAllToolsBtn,
      mobileAllToolsPage,
      mobileAllToolsBack
    });
  }
});