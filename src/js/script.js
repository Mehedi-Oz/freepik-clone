// =============================================
// CONSTANTS
// =============================================
const BREAKPOINTS = {
  MOBILE: 640,
  TABLET: 768,
  DESKTOP: 1280,
};

const PAGINATION = {
  ITEMS_PER_PAGE: 20,
  MAX_PAGES: 1000,
};

// Environment from PHP (default to production)
const ENVIRONMENT = window.ENVIRONMENT || 'production';

// =============================================
// GLOBAL ERROR HANDLING
// =============================================
window.addEventListener('error', function (event) {
  console.error('Global error:', event.error);
  if (ENVIRONMENT === 'development') {
    console.error('Error details:', {
      message: event.message,
      filename: event.filename,
      lineno: event.lineno,
      colno: event.colno,
      error: event.error,
    });
  }
  // Prevent default error handling
  return false;
});

window.addEventListener('unhandledrejection', function (event) {
  console.error('Unhandled promise rejection:', event.reason);
  if (ENVIRONMENT === 'development') {
    console.error('Rejection details:', event.reason);
  }
});

// Safe event handler wrapper
function safeEventHandler(handler) {
  return function (...args) {
    try {
      return handler.apply(this, args);
    } catch (error) {
      console.error('Error in event handler:', error);
      if (ENVIRONMENT === 'development') {
        console.error('Handler error details:', {
          error: error.message,
          stack: error.stack,
          args: args,
        });
      }
    }
  };
}

// =============================================
// UTILITY FUNCTIONS
// =============================================
// Escape HTML to prevent XSS
function escapeHtml(text) {
  const div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}

// Performance: Debounce utility
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// =============================================
// DOM ELEMENT CACHE
// =============================================
// Cache frequently accessed DOM elements
const elements = {
  // Will be populated on DOMContentLoaded
  sidebar: null,
  sidebarTexts: null,
  sidebarMenuLinks: null,
  sidebarMenuSvgs: null,
  sidebarLogoImg: null,
  sidebarSignin: null,
  sidebarHelperIcons: null,
  imageGallery: null,
  tagsContainer: null,
  // Filter elements
  filterSection: null,
  desktopFilters: {},
  // Mobile elements
  mobileSidebar: null,
  mobileSidebarOverlay: null,
  mobileMenuBtn: null,
  mobileSidebarClose: null,
};

// Function to refresh cached elements (call after DOM updates)
function refreshElementCache() {
  elements.sidebar = document.getElementById('logo-sidebar');
  elements.sidebarTexts = document.querySelectorAll('.sidebar-text');
  elements.sidebarMenuLinks = document.querySelectorAll('#logo-sidebar .sidebar-menu a');
  elements.sidebarMenuSvgs = document.querySelectorAll('#logo-sidebar .sidebar-menu svg');
  elements.sidebarLogoImg = document.getElementById('sidebar-logo-img');
  elements.sidebarSignin = document.querySelector('.sidebar-signin');
  elements.sidebarHelperIcons = document.querySelector('.sidebar-helper-icons .flex');
  elements.imageGallery = document.getElementById('image-gallery');
  elements.tagsContainer = document.getElementById('tags-container');
  elements.filterSection = document.getElementById('filters-section');

  // Cache desktop filter buttons and popups
  const filterIds = ['license', 'ai', 'orientation', 'color', 'people', 'filetype'];
  filterIds.forEach(id => {
    elements.desktopFilters[id] = {
      btn: document.getElementById(`${id}-btn`),
      popup: document.getElementById(`${id}-popup`),
      chevron: document.getElementById(`${id}-chevron`)
    };
  });

  // Cache mobile sidebar elements
  elements.mobileSidebar = document.getElementById('mobile-sidebar');
  elements.mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');
  elements.mobileMenuBtn = document.getElementById('mobile-menu-btn');
  elements.mobileSidebarClose = document.getElementById('mobile-sidebar-close');
}

// =============================================
// CONSOLIDATED INITIALIZATION
// =============================================
// Single DOMContentLoaded listener that initializes all components
document.addEventListener('DOMContentLoaded', function () {
  // Cache DOM elements first
  refreshElementCache();

  // Initialize all components in order
  initializeSidebar();
  initializeSearchBar();
  initializeDesktopFilters();
  initializeMobileSidebar();
  initializeMobileFilters();
  initializeMobileFilterPopups();
  initializeSearchTags();
  initializeSidebarFooter();
  initializeMobileAllTools();
  initializeFilterHandlers();
  initializeImageLazyLoading();
  initializePeopleCountButtons();
});

// =============================================
// IMAGE LAZY LOADING WITH INTERSECTION OBSERVER
// =============================================
function initializeImageLazyLoading() {
  // Function to load an image directly
  function loadImageDirectly(img) {
    if (!img.dataset.src) return;

    const src = img.dataset.src;
    img.src = src;
    img.removeAttribute('data-src');
    img.classList.add('loaded');
  }

  // Function to load an image with preload check
  function loadImage(img) {
    if (!img.dataset.src) return;
    if (img.src && img.src !== img.dataset.src && !img.src.includes('data:image/svg')) {
      // Already loaded
      return;
    }

    const imageLoader = new Image();
    imageLoader.onload = function () {
      img.src = img.dataset.src;
      img.classList.remove('loading');
      img.classList.add('loaded');
      img.removeAttribute('data-src');
    };
    imageLoader.onerror = function () {
      console.error('Failed to load image:', img.dataset.src);
      img.classList.add('error');
      img.classList.remove('loading');
    };
    img.classList.add('loading');
    imageLoader.src = img.dataset.src;
  }

  // Function to check if image is in viewport
  function isInViewport(img) {
    const rect = img.getBoundingClientRect();
    return (
      rect.top < window.innerHeight + 200 &&
      rect.bottom > -200 &&
      rect.left < window.innerWidth + 200 &&
      rect.right > -200
    );
  }

  // Load all images that are already in viewport immediately
  function loadVisibleImages() {
    document.querySelectorAll('img[data-src]').forEach((img) => {
      if (isInViewport(img)) {
        loadImageDirectly(img);
      }
    });
  }

  // Initial load of visible images
  loadVisibleImages();

  // Fallback: If images don't load after 500ms, load them all directly
  setTimeout(() => {
    const remainingImages = document.querySelectorAll('img[data-src]');
    if (remainingImages.length > 0) {
      remainingImages.forEach((img) => {
        loadImageDirectly(img);
      });
    }
  }, 500);

  // Check if Intersection Observer is supported
  if (!('IntersectionObserver' in window)) {
    // Fallback: Load all remaining images after a short delay
    setTimeout(() => {
      document.querySelectorAll('img[data-src]').forEach((img) => {
        loadImageDirectly(img);
      });
    }, 100);
    return;
  }

  // Create Intersection Observer with options
  const imageObserver = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          if (img.dataset.src) {
            loadImageDirectly(img);
            observer.unobserve(img);
          }
        }
      });
    },
    {
      rootMargin: '200px', // Start loading 200px before image enters viewport
      threshold: 0.01,
    }
  );

  // Store observer globally so it can be reused
  window.imageObserver = imageObserver;

  // Observe all remaining lazy images
  document.querySelectorAll('img[data-src]').forEach((img) => {
    imageObserver.observe(img);
    img.classList.add('observed');
  });

  // Also check again after a short delay (in case layout changed)
  setTimeout(loadVisibleImages, 100);
}

// Function to observe new images (called after AJAX updates)
function observeLazyImages() {
  function isInViewport(img) {
    const rect = img.getBoundingClientRect();
    return (
      rect.top < window.innerHeight + 200 &&
      rect.bottom > -200 &&
      rect.left < window.innerWidth + 200 &&
      rect.right > -200
    );
  }

  function loadImageDirectly(img) {
    if (!img.dataset.src) return;
    const src = img.dataset.src;
    img.src = src;
    img.removeAttribute('data-src');
    img.classList.add('loaded');
  }

  if (!window.imageObserver) {
    // Fallback: if observer not available, load all images directly
    document.querySelectorAll('img[data-src]').forEach((img) => {
      loadImageDirectly(img);
    });
    return;
  }

  // Load visible images immediately, observe the rest
  document.querySelectorAll('img[data-src]').forEach((img) => {
    if (!img.classList.contains('observed')) {
      if (isInViewport(img)) {
        // Already visible, load immediately
        loadImageDirectly(img);
      } else {
        // Observe for later
        window.imageObserver.observe(img);
        img.classList.add('observed');
      }
    }
  });
}

// =============================================
// INITIALIZATION FUNCTIONS
// =============================================

// Sidebar collapse/expand
function initializeSidebar() {
  const sidebar = elements.sidebar || document.getElementById('logo-sidebar');
  const collapseBtn = document.getElementById('sidebar-collapse-btn');
  const mainContent = document.querySelector('.ml-64');
  const sidebarLogo = document.querySelector('.sidebar-logo');
  const sidebarDivider = document.querySelector('.sidebar-divider');
  const headerLogo = document.querySelector('header img');

  let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

  function handleResize() {
    const screenWidth = window.innerWidth;

    if (screenWidth < BREAKPOINTS.DESKTOP) {
      // Mobile view: hide collapse button, sidebar is always hidden on mobile
      if (collapseBtn) {
        collapseBtn.style.display = 'none';
      }

      // On mobile, sidebar is hidden (display: none via CSS max-sm:hidden)
      // Don't manipulate classes here to avoid conflicts
    } else if (screenWidth >= BREAKPOINTS.DESKTOP) {
      // Desktop view: show collapse button and apply user preference
      if (collapseBtn) {
        collapseBtn.style.display = 'block';
      }

      // Apply the user's preferred state
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
    // Use cached elements
    if (elements.sidebarTexts) {
      elements.sidebarTexts.forEach((text) => {
        text.classList.add('hidden');
      });
    }
    if (elements.sidebarLogoImg) {
      elements.sidebarLogoImg.classList.add('hidden');
    }
    sidebarDivider.classList.remove('mx');
    sidebarDivider.classList.add('mx-2');
    if (elements.sidebarSignin) {
      elements.sidebarSignin.classList.add('hidden');
    }

    if (elements.sidebarMenuLinks) {
      elements.sidebarMenuLinks.forEach((link) => {
        link.classList.remove('p-2');
        link.classList.add('p-1', 'justify-center');
      });
    }
    if (elements.sidebarMenuSvgs) {
      elements.sidebarMenuSvgs.forEach((svg) => {
        svg.classList.add('m-1');
      });
    }

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
    const foucStyle = document.getElementById('sidebar-fouc-style');
    if (foucStyle) {
      foucStyle.remove();
    }

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
      // Use cached elements
      if (elements.sidebarTexts) {
        elements.sidebarTexts.forEach((text) => {
          text.classList.remove('hidden');
        });
      }
      if (elements.sidebarLogoImg) {
        elements.sidebarLogoImg.classList.remove('hidden');
      }
      if (elements.sidebarSignin) {
        elements.sidebarSignin.classList.remove('hidden');
      }
    }, 150);
    sidebarDivider.classList.add('mx');
    sidebarDivider.classList.remove('mx-2');

    if (elements.sidebarMenuLinks) {
      elements.sidebarMenuLinks.forEach((link) => {
        link.classList.add('p-2');
        link.classList.remove('p-1', 'justify-center');
      });
    }
    if (elements.sidebarMenuSvgs) {
      elements.sidebarMenuSvgs.forEach((svg) => {
        svg.classList.remove('m-1');
      });
    }

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
    document
      .querySelector('.sidebar-helper-icons .flex > div')
      .classList.remove('flex-col', 'gap-2');
    document
      .querySelector('.sidebar-helper-icons .flex > div')
      .children[1].classList.remove('hidden');
  }

  window.addEventListener('resize', debounce(handleResize, 250));
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
}

// Search bar clear button
function initializeSearchBar() {
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
}

// Close <details> elements when clicking outside
document.addEventListener('click', function (e) {
  const details = document.querySelectorAll('details');
  details.forEach((detail) => {
    if (detail.open && !detail.contains(e.target)) {
      detail.open = false;
    }
  });
});

// Filter bar toggle with cache
const chevron = document.querySelector('.chevron');
const filtersButton = chevron?.closest('button');
const target = document.getElementById('filters-section');

// Load cached state (default: closed/up)
let isDown = localStorage.getItem('filterDropdownOpen') === 'true';

// Function to check if we're on desktop
function isDesktopView() {
  return window.innerWidth >= BREAKPOINTS.MOBILE; // sm breakpoint in Tailwind
}

// Apply cached state on page load (only on desktop)
if (chevron && target && isDesktopView()) {
  if (isDown) {
    chevron.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />`;
    target.style.display = 'flex';
  } else {
    chevron.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />`;
    target.style.display = 'none';
  }

  // Remove FOUC style now that JS has taken over
  const foucStyle = document.getElementById('filter-fouc-style');
  if (foucStyle) {
    foucStyle.remove();
  }
}

filtersButton?.addEventListener('click', () => {
  const foucStyle = document.getElementById('filter-fouc-style');
  if (foucStyle) {
    foucStyle.remove();
  }

  chevron.innerHTML = isDown
    ? `<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />`
    : `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />`;
  isDown = !isDown;

  // Cache the new state
  localStorage.setItem('filterDropdownOpen', isDown);

  if (target) {
    target.style.display = target.style.display === 'none' ? 'flex' : 'none';
  }
});

// Reset filter display on resize to prevent conflicts between mobile and desktop views
window.addEventListener(
  'resize',
  debounce(() => {
    if (target) {
      if (!isDesktopView()) {
        // On mobile, hide desktop filters
        target.style.display = 'none';
      } else {
        // On desktop, restore cached state
        target.style.display = isDown ? 'flex' : 'none';
      }
    }
  }, 250)
);

// Desktop filter popups
function initializeDesktopFilters() {
  const filterElements = [
    { btn: 'license-btn', popup: 'license-popup', chevron: 'license-chevron' },
    { btn: 'ai-btn', popup: 'ai-popup', chevron: 'ai-chevron' },
    { btn: 'orientation-btn', popup: 'orientation-popup', chevron: 'orientation-chevron' },
    { btn: 'color-btn', popup: 'color-popup', chevron: 'color-chevron' },
    { btn: 'people-btn', popup: 'people-popup', chevron: 'people-chevron' },
    { btn: 'filetype-btn', popup: 'filetype-popup', chevron: 'filetype-chevron' },
  ];

  function positionPopup(button, popup) {
    const buttonRect = button.getBoundingClientRect();
    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
    popup.style.left = buttonRect.left + scrollLeft + 'px';
    popup.style.top = buttonRect.bottom + 8 + 'px';
  }

  function closeAllPopups(except = null) {
    Object.values(elements.desktopFilters).forEach((element) => {
      const { popup, chevron } = element;
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

  // Modify the filter popup logic to allow multiple filters to remain open simultaneously
  Object.values(elements.desktopFilters).forEach((element) => {
    const { btn, popup, chevron } = element;

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = popup.classList.contains('hidden');

        if (isHidden) {
          if (isDesktopView()) {
            closeAllPopups(popup);
          }
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

  document.addEventListener('click', (e) => {
    const isInsideFilter = e.target.closest('[id$="-btn"], [id$="-chevron"], [id$="-popup"]');
    const isInsideRelevance =
      e.target.closest('#relevance-chevron, #relevance-popup') ||
      e.target.closest('li:has(#relevance-chevron)');
    if (!isInsideFilter && !isInsideRelevance) {
      closeAllPopups();
    }
  });

  window.addEventListener('scroll', () => {
    filterElements.forEach((element) => {
      const btn = document.getElementById(element.btn);
      const popup = document.getElementById(element.popup);
      if (btn && popup && !popup.classList.contains('hidden')) {
        positionPopup(btn, popup);
      }
    });
  });
  window.addEventListener(
    'resize',
    debounce(() => {
      filterElements.forEach((element) => {
        const btn = document.getElementById(element.btn);
        const popup = document.getElementById(element.popup);
        if (btn && popup && !popup.classList.contains('hidden')) {
          positionPopup(btn, popup);
        }
      });
    }, 250)
  );

  filterElements.forEach((element) => {
    const popup = document.getElementById(element.popup);
    if (popup) {
      popup.classList.add('hidden');
      popup.style.display = '';
    }
  });

  if (relevancePopup) {
    relevancePopup.classList.add('hidden');
  }
}

// Button group toggles
// Button group toggles
function initializePeopleCountButtons() {
  document.querySelectorAll('.people-count-btn').forEach((btn) => {
    btn.addEventListener('click', function () {
      document
        .querySelectorAll('.people-count-btn')
        .forEach((b) => b.classList.remove('bg-green-600'));
      this.classList.add('bg-green-600');
    });
  });
}

// Mobile sidebar
function initializeMobileSidebar() {
  const { mobileSidebarOverlay, mobileSidebar, mobileMenuBtn, mobileSidebarClose } = elements;

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
}

// Mobile filter overlay and All Images dropdown
function initializeMobileFilters() {
  const mobileFiltersBtn = document.getElementById('mobile-filters-btn');
  const mobileFilterOverlay = document.getElementById('mobile-filter-overlay');
  const closeFilterOverlayBtn = document.getElementById('close-filter-overlay');
  const mobileHeaderDim = document.getElementById('mobile-header-dim');

  // All Images dropdown elements
  const mobileAllImagesBtn = document.getElementById('mobile-all-images-btn');
  const mobileAllImagesDropdown = document.getElementById('mobile-all-images-dropdown');
  const mobileAllImagesText = document.getElementById('mobile-all-images-text');
  const mobileAllImagesChevron = document.getElementById('mobile-all-images-chevron');

  // Open mobile filter overlay
  mobileFiltersBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    // Close All Images dropdown if open
    if (mobileAllImagesDropdown) {
      mobileAllImagesDropdown.classList.add('hidden');
      mobileAllImagesChevron?.classList.remove('rotate-180');
    }
    if (mobileFilterOverlay) {
      mobileFilterOverlay.classList.remove('hidden');
      mobileHeaderDim?.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }
  });

  // Close mobile filter overlay
  closeFilterOverlayBtn?.addEventListener('click', () => {
    if (mobileFilterOverlay) {
      mobileFilterOverlay.classList.add('hidden');
      mobileHeaderDim?.classList.add('hidden');
      document.body.style.overflow = '';
    }
  });

  // Toggle All Images dropdown
  mobileAllImagesBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    const isHidden = mobileAllImagesDropdown?.classList.contains('hidden');

    if (isHidden) {
      mobileAllImagesDropdown?.classList.remove('hidden');
      mobileAllImagesChevron?.classList.add('rotate-180');
    } else {
      mobileAllImagesDropdown?.classList.add('hidden');
      mobileAllImagesChevron?.classList.remove('rotate-180');
    }
  });

  // Handle category option selection
  const categoryOptions = document.querySelectorAll('.mobile-category-option');
  const categoryRadios = document.querySelectorAll('input[name="mobile-category"]');

  categoryRadios.forEach((radio) => {
    radio.addEventListener('change', function () {
      const selectedOption = this.closest('.mobile-category-option');
      const categoryText = selectedOption?.querySelector('span')?.textContent.trim();

      // Update button text
      if (mobileAllImagesText && categoryText) {
        mobileAllImagesText.textContent = categoryText;
      }

      // Update text colors
      categoryOptions.forEach((opt) => {
        opt.classList.remove('text-white');
        opt.classList.add('text-gray-400');
      });
      if (selectedOption) {
        selectedOption.classList.add('text-white');
        selectedOption.classList.remove('text-gray-400');
      }

      // Close dropdown
      mobileAllImagesDropdown?.classList.add('hidden');
      mobileAllImagesChevron?.classList.remove('rotate-180');
    });
  });

  // Close dropdown when clicking outside
  document.addEventListener('click', (e) => {
    if (
      !e.target.closest('#mobile-all-images-btn') &&
      !e.target.closest('#mobile-all-images-dropdown')
    ) {
      mobileAllImagesDropdown?.classList.add('hidden');
      mobileAllImagesChevron?.classList.remove('rotate-180');
    }
  });
}

// Mobile filter popups
function initializeMobileFilterPopups() {
  const mobileFilterElements = [
    { btn: 'mobile-license-btn', popup: 'mobile-license-popup' },
    { btn: 'mobile-ai-btn', popup: 'mobile-ai-popup' },
    { btn: 'mobile-orientation-btn', popup: 'mobile-orientation-popup' },
    { btn: 'mobile-color-btn', popup: 'mobile-color-popup' },
    { btn: 'mobile-people-btn', popup: 'mobile-people-popup' },
    { btn: 'mobile-filetype-btn', popup: 'mobile-filetype-popup' },
  ];

  mobileFilterElements.forEach((element) => {
    const btn = document.getElementById(element.btn);
    const popup = document.getElementById(element.popup);

    if (btn && popup) {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = popup.classList.contains('hidden');

        if (isHidden) {
          popup.classList.remove('hidden');
        } else {
          popup.classList.add('hidden');
        }
      });
      popup.addEventListener('click', (e) => e.stopPropagation());
    }
  });
}

// Image card overlays
function initializeImageCards() {
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
    </svg>`,
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

  // Image action functions
  function downloadImage(imageId) {
    try {
      const imageCard = document.querySelector(`[data-image="${imageId}"]`);
      const imgElement = imageCard?.querySelector('img');
      if (imgElement && imgElement.src) {
        const link = document.createElement('a');
        link.href = imgElement.src;
        link.download = imgElement.alt || `image-${imageId}`;
        link.target = '_blank';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        showNotification('Download started', 'success');
      } else {
        showNotification('Image not found', 'error');
      }
    } catch (error) {
      console.error('Error downloading image:', error);
      showNotification('Failed to download image', 'error');
    }
  }

  function openImageEditor(imageId) {
    try {
      const imageCard = document.querySelector(`[data-image="${imageId}"]`);
      const imgElement = imageCard?.querySelector('img');
      if (imgElement && imgElement.src) {
        // Open image in new window/tab for editing
        window.open(imgElement.src, '_blank');
        showNotification('Opening image editor...', 'info');
      } else {
        showNotification('Image not found', 'error');
      }
    } catch (error) {
      console.error('Error opening image editor:', error);
      showNotification('Failed to open image editor', 'error');
    }
  }

  function saveToCollection(imageId) {
    try {
      // Save to localStorage as a simple collection
      const collections = JSON.parse(localStorage.getItem('imageCollections') || '[]');
      if (!collections.includes(imageId)) {
        collections.push(imageId);
        localStorage.setItem('imageCollections', JSON.stringify(collections));
        return true;
      }
      return false;
    } catch (error) {
      console.error('Error saving to collection:', error);
      return false;
    }
  }

  function findSimilarImages(imageId) {
    try {
      const imageCard = document.querySelector(`[data-image="${imageId}"]`);
      const imgElement = imageCard?.querySelector('img');
      if (imgElement && imgElement.alt) {
        // Use the image alt text as search query
        const searchInput = document.querySelector('input[type="search"]');
        if (searchInput) {
          searchInput.value = imgElement.alt;
          searchInput.dispatchEvent(new Event('input', { bubbles: true }));
          // Trigger search
          const searchForm = searchInput.closest('form') || document.querySelector('form');
          if (searchForm) {
            searchForm.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
          }
        }
        showNotification('Searching for similar images...', 'info');
      } else {
        showNotification('Image information not available', 'error');
      }
    } catch (error) {
      console.error('Error finding similar images:', error);
      showNotification('Failed to find similar images', 'error');
    }
  }

  function showNotification(message, type = 'info') {
    try {
      // Create notification element
      const notification = document.createElement('div');
      notification.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;

      // Set colors based on type
      const colors = {
        success: 'bg-green-600 text-white',
        error: 'bg-red-600 text-white',
        info: 'bg-blue-600 text-white',
        warning: 'bg-yellow-600 text-white',
      };

      notification.className += ' ' + (colors[type] || colors.info);
      notification.textContent = message;

      document.body.appendChild(notification);

      // Animate in
      requestAnimationFrame(() => {
        notification.classList.remove('translate-x-full');
      });

      // Remove after 3 seconds
      setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
          if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
          }
        }, 300);
      }, 3000);
    } catch (error) {
      console.error('Error showing notification:', error);
      // Fallback to console
      console.log(`[${type.toUpperCase()}] ${message}`);
    }
  }

  function handleImageAction(action, imageId, imageAlt) {
    try {
      switch (action) {
        case 'download':
          downloadImage(imageId);
          break;

        case 'edit':
          openImageEditor(imageId);
          break;

        case 'save': {
          const saved = saveToCollection(imageId);
          if (saved) {
            showNotification('Image saved to collection!', 'success');
          } else {
            showNotification('Image already in collection', 'info');
          }
          break;
        }

        case 'discover':
          findSimilarImages(imageId);
          break;

        default:
          console.warn('Unknown image action:', action);
      }
    } catch (error) {
      console.error('Error handling image action:', error);
      showNotification('An error occurred. Please try again.', 'error');
    }
  }

  const imageCards = document.querySelectorAll('.image-card');

  imageCards.forEach((card) => {
    card.innerHTML += createImageOverlay();

    const downloadBtn = card.querySelector('.download-btn');
    const editBtn = card.querySelector('.edit-btn');
    const saveBtn = card.querySelector('.save-btn');
    const discoverBtn = card.querySelector('.discover-btn');

    const imageId = card.dataset.image;
    const imageAlt = card.querySelector('img').alt;

    downloadBtn?.addEventListener(
      'click',
      safeEventHandler((e) => {
        e.preventDefault();
        handleImageAction('download', imageId, imageAlt);
      })
    );

    editBtn?.addEventListener(
      'click',
      safeEventHandler((e) => {
        e.preventDefault();
        handleImageAction('edit', imageId, imageAlt);
      })
    );

    saveBtn?.addEventListener(
      'click',
      safeEventHandler((e) => {
        e.preventDefault();
        handleImageAction('save', imageId, imageAlt);
      })
    );

    discoverBtn?.addEventListener(
      'click',
      safeEventHandler((e) => {
        e.preventDefault();
        handleImageAction('discover', imageId, imageAlt);
      })
    );
  });
}

// Search tags with arrow controls
function initializeSearchTags() {
  const searchInput = document.querySelector('input[type="search"]');
  const searchTags = document.querySelectorAll('.overflow-x-auto ul li');
  const tagsContainer = document.getElementById('tags-container');
  const scrollLeftBtn = document.getElementById('tags-scroll-left');
  const scrollRightBtn = document.getElementById('tags-scroll-right');

  searchTags.forEach((tag) => {
    tag.addEventListener('click', function () {
      const tagText = this.textContent.trim();

      if (searchInput) {
        searchInput.value = tagText;
      }

      window.scrollTo({
        top: 0,
        behavior: 'smooth',
      });

      searchTags.forEach((t) => t.classList.remove('bg-gray-600'));
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
        behavior: 'smooth',
      });
    });

    scrollRightBtn.addEventListener('click', () => {
      tagsContainer.scrollBy({
        left: scrollAmount,
        behavior: 'smooth',
      });
    });

    tagsContainer.addEventListener('scroll', updateArrows);
    updateArrows();
    window.addEventListener('resize', debounce(updateArrows, 250));
  }
}

// Sidebar popup handler
function initializeSidebarFooter() {
  const sidebar = document.getElementById('logo-sidebar');
  const sidebarFooterIcons = document.querySelector('.sidebar-helper-icons');

  const popupRegistry = new Set();

  initPopupHandler({
    buttonId: 'more-options-btn',
    popupId: 'more-options-popup',
    popupRegistry: popupRegistry,
    onOpen: function () {
      const collapsedFooterIcons = document.getElementById('collapsed-footer-icons');
      if (sidebar?.classList.contains('w-16') && collapsedFooterIcons) {
        collapsedFooterIcons.classList.remove('hidden');
      }
    },
    onClose: function () {
      const collapsedFooterIcons = document.getElementById('collapsed-footer-icons');
      if (collapsedFooterIcons) {
        collapsedFooterIcons.classList.add('hidden');
      }
    },
  });

  initPopupHandler({
    buttonId: 'all-tools-btn',
    popupId: 'all-tools-popup',
    popupRegistry: popupRegistry,
  });

  const collapsedFooterIcons = document.getElementById('collapsed-footer-icons');
  const collapsedThemeBtn = collapsedFooterIcons?.querySelector('[title="Theme"]');

  if (collapsedThemeBtn) {
    setupThemePopup(collapsedThemeBtn);
  }

  if (sidebar && sidebarFooterIcons) {
    const observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        if (mutation.attributeName === 'class') {
          const isCollapsed = sidebar.classList.contains('w-16');
          const helperIconsContainer = sidebarFooterIcons.querySelector('.flex > div');
          if (helperIconsContainer) {
            helperIconsContainer.style.display = isCollapsed ? 'none' : 'flex';
          }
          if (!isCollapsed && collapsedFooterIcons) {
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
}

// Popup handler function
function initPopupHandler(config) {
  const { buttonId, popupId, popupRegistry, onOpen, onClose } = config;
  const button = document.getElementById(buttonId);
  const popup = document.getElementById(popupId);

  if (!button || !popup) return;

  function closeOtherPopups() {
    if (popupRegistry) {
      popupRegistry.forEach((otherPopup) => {
        if (otherPopup.element !== popup && !otherPopup.element.classList.contains('hidden')) {
          otherPopup.element.classList.add('hidden');
          if (otherPopup.onClose) {
            otherPopup.onClose();
          }
        }
      });
    }
  }

  if (popupRegistry) {
    popupRegistry.add({
      element: popup,
      onClose: onClose,
    });
  }

  button.addEventListener('click', function (e) {
    e.stopPropagation();

    const isCurrentlyHidden = popup.classList.contains('hidden');

    closeOtherPopups();

    if (isCurrentlyHidden) {
      popup.classList.remove('hidden');
      if (onOpen) onOpen();
    } else {
      popup.classList.add('hidden');
      if (onClose) onClose();
    }
  });

  document.addEventListener('click', function (e) {
    if (!button.contains(e.target) && !popup.contains(e.target)) {
      popup.classList.add('hidden');
      if (onClose) onClose();
    }
  });

  popup.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', function () {
      popup.classList.add('hidden');
      if (onClose) onClose();
    });
  });

  popup.addEventListener('click', function (e) {
    e.stopPropagation();
  });
}

// Theme popup setup function
function setupThemePopup(themeButton) {
  const themePopup = document.createElement('div');
  themePopup.className =
    'absolute bottom-full mb-2 w-32 bg-gray-800 border border-gray-600 rounded shadow-lg z-50 text-white text-sm hidden';
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
  themeButton.parentNode.insertBefore(themeBtnWrapper, themeButton);
  themeBtnWrapper.appendChild(themeButton);
  themeBtnWrapper.appendChild(themePopup);

  themeButton.addEventListener('click', function (e) {
    e.stopPropagation();
    themePopup.classList.toggle('hidden');
  });

  document.addEventListener('click', function (e) {
    if (!themeBtnWrapper.contains(e.target)) {
      themePopup.classList.add('hidden');
    }
  });

  themePopup.querySelectorAll('li').forEach((item) => {
    item.addEventListener('click', function () {
      themePopup.classList.add('hidden');
    });
  });
}

// Mobile All Tools page
function initializeMobileAllTools() {
  const mobileAllToolsBtn = document.querySelector(
    '#mobile-sidebar ul:nth-of-type(2) li:nth-child(4) a'
  );
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

    mobileAllToolsPage.querySelectorAll('a:not(#mobile-all-tools-back)').forEach((link) => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        mobileAllToolsPage.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      });
    });
  }
}

// Filter AJAX handlers
function initializeFilterHandlers() {
  // Helper function to highlight filter button when non-default option is selected
  function updateFilterButtonHighlight(buttonId, isActive) {
    const btn = document.getElementById(buttonId);
    if (btn) {
      if (isActive) {
        btn.style.backgroundColor = 'oklch(44.3% 0.11 240.79)';
      } else {
        btn.style.backgroundColor = '';
      }
    }
  }

  // =============================================
  // UNIFIED FILTER HANDLER
  // =============================================
  /**
   * Unified filter handler for desktop and mobile filters
   * @param {string} filterName - Filter parameter name (e.g., 'ai-type', 'filetype', 'orientation', 'license')
   * @param {string} defaultValue - Default value that removes the filter (e.g., 'show_all', 'all')
   * @param {string} buttonId - ID of the filter button to highlight
   * @param {string} popupId - ID of the popup to close after selection
   * @param {boolean} autoApply - Whether to auto-apply (desktop) or just close popup (mobile)
   * @param {boolean} resetPage - Whether to reset page to 1 when filter changes
   */
  function createFilterHandler(
    filterName,
    defaultValue,
    buttonId,
    popupId,
    autoApply = true,
    resetPage = true
  ) {
    return function (radio) {
      radio.addEventListener('change', function () {
        if (autoApply) {
          // Desktop: Auto-apply filter
          const urlParams = new URLSearchParams(window.location.search);

          if (resetPage) {
            urlParams.delete('page');
          }

          if (this.value === defaultValue) {
            urlParams.delete(filterName);
          } else {
            urlParams.set(filterName, this.value);
          }

          // Update URL without reloading
          const newUrl = window.location.pathname + '?' + urlParams.toString();
          window.history.pushState({}, '', newUrl);

          // Load images via AJAX immediately
          loadImagesAjax(urlParams);

          // Highlight button if non-default option selected
          const isActive = this.value !== defaultValue;
          updateFilterButtonHighlight(buttonId, isActive);

          // Cache filter state
          saveFiltersToCache();
        } else {
          // Mobile: Just close popup, filters applied via Apply button
        }

        // Close the popup after selection
        const popup = document.getElementById(popupId);
        if (popup) {
          popup.classList.add('hidden');
        }
      });
    };
  }

  // =============================================
  // FILTER CACHING SYSTEM
  // =============================================
  const FILTER_CACHE_KEY = 'pixahuntFilters';

  // Save all filter states to localStorage
  function saveFiltersToCache() {
    const filters = {
      'ai-type': document.querySelector('input[name="ai-type"]:checked')?.value || 'show_all',
      license: document.querySelector('input[name="license"]:checked')?.value || 'all',
      orientation: document.querySelector('input[name="orientation"]:checked')?.value || 'all',
      filetype: document.querySelector('input[name="filetype"]:checked')?.value || 'all',
      color: new URLSearchParams(window.location.search).get('color') || 'all',
      people: new URLSearchParams(window.location.search).get('people') || 'all',
    };
    localStorage.setItem(FILTER_CACHE_KEY, JSON.stringify(filters));
  }

  // Load and apply filters from URL parameters
  function loadFiltersFromURL() {
    const urlParams = new URLSearchParams(window.location.search);

    // Get filter values from URL or use defaults
    const aiType = urlParams.get('ai-type') || 'show_all';
    const license = urlParams.get('license') || 'all';
    const orientation = urlParams.get('orientation') || 'all';
    const filetype = urlParams.get('filetype') || 'all';
    const color = urlParams.get('color') || 'all';
    const people = urlParams.get('people') || 'all';

    // Apply AI filter
    const aiRadio = document.querySelector(`input[name="ai-type"][value="${aiType}"]`);
    const mobileAiRadio = document.querySelector(`input[name="mobile-ai-type"][value="${aiType}"]`);
    if (aiRadio) aiRadio.checked = true;
    if (mobileAiRadio) mobileAiRadio.checked = true;
    updateFilterButtonHighlight('ai-btn', aiType !== 'show_all');
    updateFilterButtonHighlight('mobile-ai-btn', aiType !== 'show_all');

    // Apply License filter
    const licenseRadio = document.querySelector(`input[name="license"][value="${license}"]`);
    const mobileLicenseRadio = document.querySelector(
      `input[name="mobile-license"][value="${license}"]`
    );
    if (licenseRadio) licenseRadio.checked = true;
    if (mobileLicenseRadio) mobileLicenseRadio.checked = true;
    updateFilterButtonHighlight('license-btn', license !== 'all');
    updateFilterButtonHighlight('mobile-license-btn', license !== 'all');

    // Apply Orientation filter
    const orientationRadio = document.querySelector(
      `input[name="orientation"][value="${orientation}"]`
    );
    const mobileOrientationRadio = document.querySelector(
      `input[name="mobile-orientation"][value="${orientation}"]`
    );
    if (orientationRadio) orientationRadio.checked = true;
    if (mobileOrientationRadio) mobileOrientationRadio.checked = true;
    updateFilterButtonHighlight('orientation-btn', orientation !== 'all');
    updateFilterButtonHighlight('mobile-orientation-btn', orientation !== 'all');

    // Apply Filetype filter
    const filetypeRadio = document.querySelector(`input[name="filetype"][value="${filetype}"]`);
    const mobileFiletypeRadio = document.querySelector(
      `input[name="mobile-filetype"][value="${filetype}"]`
    );
    if (filetypeRadio) filetypeRadio.checked = true;
    if (mobileFiletypeRadio) mobileFiletypeRadio.checked = true;
    updateFilterButtonHighlight('filetype-btn', filetype !== 'all');
    updateFilterButtonHighlight('mobile-filetype-btn', filetype !== 'all');

    // Apply Color filter highlight
    updateFilterButtonHighlight('color-btn', color !== 'all');
    updateFilterButtonHighlight('mobile-color-btn', color !== 'all');

    // Apply People filter highlight
    updateFilterButtonHighlight('people-btn', people !== 'all');
    updateFilterButtonHighlight('mobile-people-btn', people !== 'all');
  }

  // Load filters from URL on page load
  loadFiltersFromURL();

  // Reload filters from URL on resize (for seamless mobile/desktop switching)
  window.addEventListener(
    'resize',
    debounce(() => {
      loadFiltersFromURL();
    }, 250)
  );

  document.getElementById('apply-filters-btn')?.addEventListener('click', function () {
    const urlParams = new URLSearchParams(window.location.search);

    // Reset page to 1 when filters change
    urlParams.delete('page');

    // Handle AI Type
    const aiType = document.querySelector("input[name='ai-type']:checked");
    if (aiType) {
      if (aiType.value === 'show_all') {
        urlParams.delete('ai-type');
      } else {
        urlParams.set('ai-type', aiType.value);
      }
    } else {
      // Default behavior if nothing checked (shouldn't happen usually)
      urlParams.delete('ai-type');
    }

    // Update URL without reloading
    const newUrl = window.location.pathname + '?' + urlParams.toString();
    window.history.pushState({}, '', newUrl);

    // Load images via AJAX
    loadImagesAjax(urlParams);
  });

  // Function to check if any desktop filter is active and show/hide Clear All button
  window.updateDesktopClearAllVisibility = function () {
    const clearBtn = document.getElementById('clear-desktop-filters');
    if (!clearBtn) return;

    const urlParams = new URLSearchParams(window.location.search);

    // Check URL params for active filters
    const hasLicense = urlParams.has('license') && urlParams.get('license') !== 'all';
    const hasAiType = urlParams.has('ai-type') && urlParams.get('ai-type') !== 'show_all';
    const hasOrientation = urlParams.has('orientation') && urlParams.get('orientation') !== 'all';
    const hasFiletype = urlParams.has('filetype') && urlParams.get('filetype') !== 'all';
    const hasColor = urlParams.has('color') && urlParams.get('color') !== 'all';
    const hasPeople = urlParams.has('people') && urlParams.get('people') !== 'all';

    const hasActiveFilter =
      hasLicense || hasAiType || hasOrientation || hasFiletype || hasColor || hasPeople;

    if (hasActiveFilter) {
      clearBtn.classList.remove('hidden');
    } else {
      clearBtn.classList.add('hidden');
    }
  };

  // Alias for local usage
  const updateDesktopClearAllVisibility = window.updateDesktopClearAllVisibility;

  // Update desktop Clear All button visibility on page load
  updateDesktopClearAllVisibility();

  // Clear Desktop Filters button
  document.getElementById('clear-desktop-filters')?.addEventListener('click', function () {
    // Reset all desktop filter radio buttons to default values
    const defaultLicense = document.querySelector("input[name='license'][value='all']");
    const defaultAiType = document.querySelector("input[name='ai-type'][value='show_all']");
    const defaultOrientation = document.querySelector("input[name='orientation'][value='all']");
    const defaultFiletype = document.querySelector("input[name='filetype'][value='all']");

    if (defaultLicense) defaultLicense.checked = true;
    if (defaultAiType) defaultAiType.checked = true;
    if (defaultOrientation) defaultOrientation.checked = true;
    if (defaultFiletype) defaultFiletype.checked = true;

    // Clear URL params for filters
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.delete('license');
    urlParams.delete('ai-type');
    urlParams.delete('orientation');
    urlParams.delete('filetype');
    urlParams.delete('color');
    urlParams.delete('people');
    urlParams.delete('page');

    // Update URL without reloading
    const newUrl =
      window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
    window.history.pushState({}, '', newUrl);

    // Load images via AJAX
    loadImagesAjax(urlParams);

    // Remove all desktop filter button highlights
    updateFilterButtonHighlight('license-btn', false);
    updateFilterButtonHighlight('ai-btn', false);
    updateFilterButtonHighlight('orientation-btn', false);
    updateFilterButtonHighlight('filetype-btn', false);
    updateFilterButtonHighlight('color-btn', false);
    updateFilterButtonHighlight('people-btn', false);

    // Also clear mobile filter highlights and reset radio buttons
    updateFilterButtonHighlight('mobile-license-btn', false);
    updateFilterButtonHighlight('mobile-ai-btn', false);
    updateFilterButtonHighlight('mobile-orientation-btn', false);
    updateFilterButtonHighlight('mobile-filetype-btn', false);
    updateFilterButtonHighlight('mobile-color-btn', false);
    updateFilterButtonHighlight('mobile-people-btn', false);

    const mobileDefaultLicense = document.querySelector(
      "input[name='mobile-license'][value='all']"
    );
    const mobileDefaultAiType = document.querySelector(
      "input[name='mobile-ai-type'][value='show_all']"
    );
    const mobileDefaultOrientation = document.querySelector(
      "input[name='mobile-orientation'][value='all']"
    );
    const mobileDefaultFiletype = document.querySelector(
      "input[name='mobile-filetype'][value='all']"
    );

    if (mobileDefaultLicense) mobileDefaultLicense.checked = true;
    if (mobileDefaultAiType) mobileDefaultAiType.checked = true;
    if (mobileDefaultOrientation) mobileDefaultOrientation.checked = true;
    if (mobileDefaultFiletype) mobileDefaultFiletype.checked = true;

    // Clear cache
    saveFiltersToCache();

    // Hide the Clear All button since filters are now cleared
    updateDesktopClearAllVisibility();
    updateClearAllButtonVisibility();
  });

  // Function to check if any mobile filter is active and show/hide Clear All button
  window.updateClearAllButtonVisibility = function () {
    const clearBtn = document.getElementById('clear-mobile-filters');
    if (!clearBtn) return;

    const urlParams = new URLSearchParams(window.location.search);

    // Check URL params for active filters
    const hasLicense = urlParams.has('license') && urlParams.get('license') !== 'all';
    const hasAiType = urlParams.has('ai-type') && urlParams.get('ai-type') !== 'show_all';
    const hasOrientation = urlParams.has('orientation') && urlParams.get('orientation') !== 'all';
    const hasFiletype = urlParams.has('filetype') && urlParams.get('filetype') !== 'all';
    const hasColor = urlParams.has('color') && urlParams.get('color') !== 'all';
    const hasPeople = urlParams.has('people') && urlParams.get('people') !== 'all';

    // Check current radio button selections (in case not yet applied to URL)
    const licenseSelected = document.querySelector("input[name='mobile-license']:checked")?.value;
    const aiTypeSelected = document.querySelector("input[name='mobile-ai-type']:checked")?.value;
    const orientationSelected = document.querySelector(
      "input[name='mobile-orientation']:checked"
    )?.value;
    const filetypeSelected = document.querySelector("input[name='mobile-filetype']:checked")?.value;

    const hasActiveRadio =
      (licenseSelected && licenseSelected !== 'all') ||
      (aiTypeSelected && aiTypeSelected !== 'show_all') ||
      (orientationSelected && orientationSelected !== 'all') ||
      (filetypeSelected && filetypeSelected !== 'all');

    const hasActiveFilter =
      hasLicense ||
      hasAiType ||
      hasOrientation ||
      hasFiletype ||
      hasColor ||
      hasPeople ||
      hasActiveRadio;

    if (hasActiveFilter) {
      clearBtn.classList.remove('hidden');
    } else {
      clearBtn.classList.add('hidden');
    }
  };

  // Alias for local usage
  const updateClearAllButtonVisibility = window.updateClearAllButtonVisibility;

  // Update Clear All button visibility on page load
  updateClearAllButtonVisibility();

  // Update Clear All button visibility when any mobile filter changes
  document
    .querySelectorAll(
      "input[name='mobile-license'], input[name='mobile-ai-type'], input[name='mobile-orientation'], input[name='mobile-filetype']"
    )
    .forEach((radio) => {
      radio.addEventListener('change', updateClearAllButtonVisibility);
    });

  // Also update when mobile filter overlay opens (to catch URL-based filters)
  document
    .getElementById('mobile-filters-btn')
    ?.addEventListener('click', updateClearAllButtonVisibility);

  // Clear Mobile Filters button
  document.getElementById('clear-mobile-filters')?.addEventListener('click', function () {
    // Reset all mobile filter radio buttons to default values
    const defaultLicense = document.querySelector("input[name='mobile-license'][value='all']");
    const defaultAiType = document.querySelector("input[name='mobile-ai-type'][value='show_all']");
    const defaultOrientation = document.querySelector(
      "input[name='mobile-orientation'][value='all']"
    );
    const defaultFiletype = document.querySelector("input[name='mobile-filetype'][value='all']");

    if (defaultLicense) defaultLicense.checked = true;
    if (defaultAiType) defaultAiType.checked = true;
    if (defaultOrientation) defaultOrientation.checked = true;
    if (defaultFiletype) defaultFiletype.checked = true;

    // Clear URL params for filters
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.delete('license');
    urlParams.delete('ai-type');
    urlParams.delete('orientation');
    urlParams.delete('filetype');
    urlParams.delete('color');
    urlParams.delete('people');
    urlParams.delete('page');

    // Update URL without reloading
    const newUrl =
      window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
    window.history.pushState({}, '', newUrl);

    // Load images via AJAX
    loadImagesAjax(urlParams);

    // Remove all filter button highlights
    updateFilterButtonHighlight('mobile-license-btn', false);
    updateFilterButtonHighlight('mobile-ai-btn', false);
    updateFilterButtonHighlight('mobile-orientation-btn', false);
    updateFilterButtonHighlight('mobile-filetype-btn', false);
    updateFilterButtonHighlight('mobile-color-btn', false);
    updateFilterButtonHighlight('mobile-people-btn', false);

    // Also clear desktop filter highlights
    updateFilterButtonHighlight('license-btn', false);
    updateFilterButtonHighlight('ai-btn', false);
    updateFilterButtonHighlight('orientation-btn', false);
    updateFilterButtonHighlight('filetype-btn', false);
    updateFilterButtonHighlight('color-btn', false);
    updateFilterButtonHighlight('people-btn', false);

    // Reset desktop filter radio buttons too
    const desktopDefaultLicense = document.querySelector("input[name='license'][value='all']");
    const desktopDefaultAiType = document.querySelector("input[name='ai-type'][value='show_all']");
    const desktopDefaultOrientation = document.querySelector(
      "input[name='orientation'][value='all']"
    );
    const desktopDefaultFiletype = document.querySelector("input[name='filetype'][value='all']");

    if (desktopDefaultLicense) desktopDefaultLicense.checked = true;
    if (desktopDefaultAiType) desktopDefaultAiType.checked = true;
    if (desktopDefaultOrientation) desktopDefaultOrientation.checked = true;
    if (desktopDefaultFiletype) desktopDefaultFiletype.checked = true;

    // Clear cache
    saveFiltersToCache();

    // Hide the Clear All button since filters are now cleared
    updateClearAllButtonVisibility();

    // Close the overlay
    const mobileFilterOverlay = document.getElementById('mobile-filter-overlay');
    const mobileHeaderDim = document.getElementById('mobile-header-dim');
    if (mobileFilterOverlay) {
      mobileFilterOverlay.classList.add('hidden');
      mobileHeaderDim?.classList.add('hidden');
      document.body.style.overflow = '';
    }
  });

  // Apply Mobile Filters button
  document.getElementById('apply-mobile-filters')?.addEventListener('click', function () {
    const urlParams = new URLSearchParams(window.location.search);

    // Reset page to 1 when filters change
    urlParams.delete('page');

    // Collect all mobile filter values
    const license = document.querySelector("input[name='mobile-license']:checked")?.value || 'all';
    const aiType =
      document.querySelector("input[name='mobile-ai-type']:checked")?.value || 'show_all';
    const orientation =
      document.querySelector("input[name='mobile-orientation']:checked")?.value || 'all';
    const filetype =
      document.querySelector("input[name='mobile-filetype']:checked")?.value || 'all';

    // Get color and people from URL params (set via button clicks)
    const currentColor = urlParams.get('color') || 'all';
    const currentPeople = urlParams.get('people') || 'all';

    // Clear existing filter params
    urlParams.delete('license');
    urlParams.delete('ai-type');
    urlParams.delete('orientation');
    urlParams.delete('filetype');
    urlParams.delete('color');
    urlParams.delete('people');

    // Set new filter values (only if not 'all')
    if (license !== 'all') urlParams.set('license', license);
    if (aiType !== 'show_all') urlParams.set('ai-type', aiType);
    if (orientation !== 'all') urlParams.set('orientation', orientation);
    if (filetype !== 'all') urlParams.set('filetype', filetype);
    if (currentColor !== 'all') urlParams.set('color', currentColor);
    if (currentPeople !== 'all') urlParams.set('people', currentPeople);

    // Update URL without reloading
    const newUrl = window.location.pathname + '?' + urlParams.toString();
    window.history.pushState({}, '', newUrl);

    // Load images via AJAX
    loadImagesAjax(urlParams);

    // Highlight active filter buttons
    updateFilterButtonHighlight('mobile-license-btn', license !== 'all');
    updateFilterButtonHighlight('mobile-ai-btn', aiType !== 'show_all');
    updateFilterButtonHighlight('mobile-orientation-btn', orientation !== 'all');
    updateFilterButtonHighlight('mobile-filetype-btn', filetype !== 'all');
    updateFilterButtonHighlight('mobile-color-btn', currentColor !== 'all');
    updateFilterButtonHighlight('mobile-people-btn', currentPeople !== 'all');

    // Cache filter state
    saveFiltersToCache();

    // Close the overlay
    const mobileFilterOverlay = document.getElementById('mobile-filter-overlay');
    const mobileHeaderDim = document.getElementById('mobile-header-dim');
    if (mobileFilterOverlay) {
      mobileFilterOverlay.classList.add('hidden');
      mobileHeaderDim?.classList.add('hidden'); // Hide header dim
      document.body.style.overflow = ''; // Restore scroll
    }
  });

  // Unified filter handlers - Desktop (auto-apply) and Mobile (close popup only)
  document
    .querySelectorAll('input[name="ai-type"]')
    .forEach(createFilterHandler('ai-type', 'show_all', 'ai-btn', 'ai-popup', true, false));
  document
    .querySelectorAll('input[name="mobile-ai-type"]')
    .forEach(createFilterHandler('ai-type', 'show_all', 'ai-btn', 'mobile-ai-popup', false, false));

  // File Type filter handlers
  document
    .querySelectorAll('input[name="filetype"]')
    .forEach(createFilterHandler('filetype', 'all', 'filetype-btn', 'filetype-popup', true, true));
  document
    .querySelectorAll('input[name="mobile-filetype"]')
    .forEach(
      createFilterHandler('filetype', 'all', 'filetype-btn', 'mobile-filetype-popup', false, false)
    );

  // Orientation filter handlers
  document
    .querySelectorAll('input[name="orientation"]')
    .forEach(
      createFilterHandler('orientation', 'all', 'orientation-btn', 'orientation-popup', true, true)
    );
  document
    .querySelectorAll('input[name="mobile-orientation"]')
    .forEach(
      createFilterHandler(
        'orientation',
        'all',
        'orientation-btn',
        'mobile-orientation-popup',
        false,
        false
      )
    );

  // License filter handlers
  document
    .querySelectorAll('input[name="license"]')
    .forEach(createFilterHandler('license', 'all', 'license-btn', 'license-popup', true, true));
  document
    .querySelectorAll('input[name="mobile-license"]')
    .forEach(
      createFilterHandler('license', 'all', 'license-btn', 'mobile-license-popup', false, false)
    );

  // Add event listener for color filter buttons (desktop and mobile)
  document.querySelectorAll('[data-color]').forEach((button) => {
    button.addEventListener('click', function () {
      const urlParams = new URLSearchParams(window.location.search);
      const colorValue = this.getAttribute('data-color');

      // Check if mobile overlay is open
      const mobileOverlay = document.getElementById('mobile-filter-overlay');
      const isOverlayOpen = mobileOverlay && !mobileOverlay.classList.contains('hidden');

      if (isOverlayOpen) {
        // Mobile overlay is open - just store value, don't auto-apply
        // Reset page when filters change
        urlParams.delete('page');
        if (colorValue === 'all') {
          urlParams.delete('color');
        } else {
          urlParams.set('color', colorValue);
        }
        // Update URL silently without reloading images
        const newUrl = window.location.pathname + '?' + urlParams.toString();
        window.history.replaceState({}, '', newUrl);
      } else {
        // Desktop or overlay closed - auto-apply
        // Reset page to 1 when filters change
        urlParams.delete('page');
        if (colorValue === 'all') {
          urlParams.delete('color');
        } else {
          urlParams.set('color', colorValue);
        }
        const newUrl = window.location.pathname + '?' + urlParams.toString();
        window.history.pushState({}, '', newUrl);
        loadImagesAjax(urlParams);

        // Highlight button if non-default option selected
        const isActive = colorValue !== 'all';
        updateFilterButtonHighlight('color-btn', isActive);
        updateFilterButtonHighlight('mobile-color-btn', isActive);

        // Cache filter state
        saveFiltersToCache();
      }

      // Close the popup after selection
      const colorPopup = document.getElementById('color-popup');
      if (colorPopup) {
        colorPopup.classList.add('hidden');
      }
      const mobileColorPopup = document.getElementById('mobile-color-popup');
      if (mobileColorPopup) {
        mobileColorPopup.classList.add('hidden');
      }
    });
  });

  // Add event listener for people filter buttons
  document.querySelectorAll('[data-people]').forEach((button) => {
    button.addEventListener('click', function () {
      const urlParams = new URLSearchParams(window.location.search);
      const peopleValue = this.getAttribute('data-people');

      // Check if mobile overlay is open
      const mobileOverlay = document.getElementById('mobile-filter-overlay');
      const isOverlayOpen = mobileOverlay && !mobileOverlay.classList.contains('hidden');

      if (isOverlayOpen) {
        // Mobile overlay is open - just store value, don't auto-apply
        // Reset page when filters change
        urlParams.delete('page');
        if (peopleValue === 'all') {
          urlParams.delete('people');
        } else {
          urlParams.set('people', peopleValue);
        }
        // Update URL silently without reloading images
        const newUrl = window.location.pathname + '?' + urlParams.toString();
        window.history.replaceState({}, '', newUrl);
      } else {
        // Desktop or overlay closed - auto-apply
        // Reset page to 1 when filters change
        urlParams.delete('page');
        if (peopleValue === 'all') {
          urlParams.delete('people');
        } else {
          urlParams.set('people', peopleValue);
        }
        const newUrl = window.location.pathname + '?' + urlParams.toString();
        window.history.pushState({}, '', newUrl);
        loadImagesAjax(urlParams);

        // Highlight button if non-default option selected
        const isActive = peopleValue !== 'all';
        updateFilterButtonHighlight('people-btn', isActive);
        updateFilterButtonHighlight('mobile-people-btn', isActive);

        // Cache filter state
        saveFiltersToCache();
      }

      // Close the popup after selection
      const peoplePopup = document.getElementById('people-popup');
      if (peoplePopup) {
        peoplePopup.classList.add('hidden');
      }
      const mobilePeoplePopup = document.getElementById('mobile-people-popup');
      if (mobilePeoplePopup) {
        mobilePeoplePopup.classList.add('hidden');
      }
    });
  });

  // Add event listener for pagination
  const prevPageButton = document.getElementById('prev-page-btn');
  const nextPageButton = document.getElementById('next-page-btn');
  const pageInput = document.querySelector('.pagination-controls input[type="text"]');

  // Get current page from URL parameters
  const paginationUrlParams = new URLSearchParams(window.location.search);
  const currentPageFromUrl = parseInt(paginationUrlParams.get('page'), 10) || 1;

  // Get total pages from the "of X" text next to the input
  const pageInfoText = pageInput?.parentElement?.textContent || '';
  const totalPagesMatch = pageInfoText.match(/of\s+(\d+)/);
  const totalPages = totalPagesMatch ? parseInt(totalPagesMatch[1], 10) : 1;

  // Initialize input with current page from URL if it's empty
  if (pageInput && !pageInput.value) {
    pageInput.value = currentPageFromUrl;
  }

  if (prevPageButton) {
    prevPageButton.addEventListener('click', () => {
      // Don't do anything if button is disabled
      if (prevPageButton.disabled) {
        return;
      }

      const currentPage =
        parseInt(paginationUrlParams.get('page'), 10) || parseInt(pageInput?.value, 10) || 1;
      const prevPage = currentPage - 1;

      // Don't go below page 1
      if (prevPage < 1) {
        return;
      }

      const url = new URL(window.location.href);
      url.searchParams.set('page', prevPage);
      window.location.href = url.toString();
    });
  }

  if (nextPageButton) {
    nextPageButton.addEventListener('click', () => {
      // Don't do anything if button is disabled
      if (nextPageButton.disabled) {
        return;
      }

      const currentPage =
        parseInt(paginationUrlParams.get('page'), 10) || parseInt(pageInput?.value, 10) || 1;
      const nextPage = currentPage + 1;

      // Don't go beyond total pages
      if (nextPage > totalPages) {
        return;
      }

      const url = new URL(window.location.href);
      url.searchParams.set('page', nextPage);
      window.location.href = url.toString();
    });
  }

  if (pageInput) {
    pageInput.addEventListener('change', (event) => {
      let newPage = parseInt(event.target.value, 10) || 1;

      // Clamp page to valid range
      if (newPage < 1) {
        newPage = 1;
      } else if (newPage > totalPages) {
        newPage = totalPages;
      }

      // Update input to show clamped value
      event.target.value = newPage;

      const url = new URL(window.location.href);
      url.searchParams.set('page', newPage);
      window.location.href = url.toString();
    });
  }

  // Mobile pagination elements
  const mobilePrevPageButton = document.getElementById('mobile-prev-page-btn');
  const mobileNextPageButton = document.getElementById('mobile-next-page-btn');
  const mobilePageInput = document.getElementById('mobile-page-input');
  const mobileTotalPagesEl = document.getElementById('mobile-total-pages');
  const mobileTotalPages = mobileTotalPagesEl
    ? parseInt(mobileTotalPagesEl.textContent, 10)
    : totalPages;

  if (mobilePrevPageButton) {
    mobilePrevPageButton.addEventListener('click', () => {
      if (mobilePrevPageButton.disabled) return;

      const currentPage =
        parseInt(paginationUrlParams.get('page'), 10) || parseInt(mobilePageInput?.value, 10) || 1;
      const prevPage = currentPage - 1;

      if (prevPage < 1) return;

      const url = new URL(window.location.href);
      url.searchParams.set('page', prevPage);
      window.location.href = url.toString();
    });
  }

  if (mobileNextPageButton) {
    mobileNextPageButton.addEventListener('click', () => {
      if (mobileNextPageButton.disabled) return;

      const currentPage =
        parseInt(paginationUrlParams.get('page'), 10) || parseInt(mobilePageInput?.value, 10) || 1;
      const nextPage = currentPage + 1;

      if (nextPage > mobileTotalPages) return;

      const url = new URL(window.location.href);
      url.searchParams.set('page', nextPage);
      window.location.href = url.toString();
    });
  }

  if (mobilePageInput) {
    mobilePageInput.addEventListener('change', (event) => {
      let newPage = parseInt(event.target.value, 10) || 1;

      // Clamp page to valid range
      if (newPage < 1) {
        newPage = 1;
      } else if (newPage > mobileTotalPages) {
        newPage = mobileTotalPages;
      }

      // Update input to show clamped value
      event.target.value = newPage;

      const url = new URL(window.location.href);
      url.searchParams.set('page', newPage);
      window.location.href = url.toString();
    });
  }
} // End of initializeFilterHandlers

// Function to update pagination controls based on new results
function updatePaginationControls(currentPage, totalPages, totalResults) {
  // Desktop elements
  const prevPageBtn = document.getElementById('prev-page-btn');
  const nextPageBtn = document.getElementById('next-page-btn');
  const pageInput = document.querySelector('.pagination-controls input[type="text"]');
  const pageInfoText = pageInput?.parentElement;

  // Mobile elements
  const mobilePrevPageBtn = document.getElementById('mobile-prev-page-btn');
  const mobileNextPageBtn = document.getElementById('mobile-next-page-btn');
  const mobilePageInput = document.getElementById('mobile-page-input');
  const mobileTotalPages = document.getElementById('mobile-total-pages');

  // Update desktop page input value
  if (pageInput) {
    pageInput.value = currentPage;
  }

  // Update desktop "of X" text
  if (pageInfoText) {
    pageInfoText.innerHTML = `Page <input type="text" class="rounded bg-gray-600 w-12 px-2 py-1 text-center" value="${currentPage}"> of ${totalPages}`;

    // Re-attach event listener to new input
    const newPageInput = pageInfoText.querySelector('input[type="text"]');
    if (newPageInput) {
      newPageInput.addEventListener('change', (event) => {
        let newPage = parseInt(event.target.value, 10) || 1;
        if (newPage < 1) newPage = 1;
        else if (newPage > totalPages) newPage = totalPages;
        event.target.value = newPage;

        const url = new URL(window.location.href);
        url.searchParams.set('page', newPage);
        window.location.href = url.toString();
      });
    }
  }

  // Update mobile page input and total pages
  if (mobilePageInput) {
    mobilePageInput.value = currentPage;
  }
  if (mobileTotalPages) {
    mobileTotalPages.textContent = totalPages;
  }

  // Helper function to update button state
  function updateButtonState(btn, isDisabled) {
    if (!btn) return;
    if (isDisabled) {
      btn.disabled = true;
      btn.classList.remove('bg-white', 'text-gray-800', 'hover:bg-gray-100');
      btn.classList.add('bg-gray-600', 'text-gray-400', 'cursor-not-allowed');
    } else {
      btn.disabled = false;
      btn.classList.add('bg-white', 'text-gray-800', 'hover:bg-gray-100');
      btn.classList.remove('bg-gray-600', 'text-gray-400', 'cursor-not-allowed');
    }
  }

  // Update Previous buttons state (desktop and mobile)
  const isPrevDisabled = currentPage <= 1;
  updateButtonState(prevPageBtn, isPrevDisabled);
  updateButtonState(mobilePrevPageBtn, isPrevDisabled);

  // Update Next buttons state (desktop and mobile)
  const isNextDisabled = currentPage >= totalPages || totalPages <= 1;
  updateButtonState(nextPageBtn, isNextDisabled);
  updateButtonState(mobileNextPageBtn, isNextDisabled);
}

// AJAX function to load images (global scope)
function loadImagesAjax(urlParams) {
  // Reset page to 1 when filters change (unless explicitly set)
  if (!urlParams.has('page')) {
    urlParams.delete('page');
  }

  const imageGallery = document.getElementById('image-gallery');
  const totalResults = document.querySelector('.tag p');

  // Show skeleton loading animation (optimized with requestAnimationFrame)
  if (imageGallery) {
    // Use requestAnimationFrame to avoid blocking main thread
    requestAnimationFrame(() => {
      const skeletonCards = Array(12)
        .fill(0)
        .map((_, i) => {
          // Vary heights for visual interest (simulating masonry)
          const heights = ['h-48', 'h-64', 'h-56', 'h-72', 'h-52', 'h-60'];
          const height = heights[i % heights.length];
          return `
          <div class="skeleton-card mb-4">
            <div class="bg-gray-700 rounded-lg ${height} w-full relative overflow-hidden animate-pulse">
              <div class="absolute inset-0 bg-gradient-to-r from-gray-700 via-gray-600 to-gray-700 skeleton-shimmer"></div>
            </div>
          </div>
        `;
        })
        .join('');

      // Update DOM in next frame for smooth rendering
      requestAnimationFrame(() => {
        imageGallery.innerHTML = skeletonCards;
      });
    });

    // Add shimmer animation style if not exists
    if (!document.getElementById('skeleton-style')) {
      const style = document.createElement('style');
      style.id = 'skeleton-style';
      style.textContent = `
        @keyframes shimmer {
          0% { transform: translateX(-100%); }
          100% { transform: translateX(100%); }
        }
        .skeleton-shimmer {
          animation: shimmer 1.5s infinite;
        }
      `;
      document.head.appendChild(style);
    }
  }

  // Show skeleton for total results
  if (totalResults) {
    totalResults.innerHTML = `
      <span class="inline-block h-5 w-24 bg-gray-700 rounded relative overflow-hidden align-middle">
        <span class="absolute inset-0 bg-gradient-to-r from-gray-700 via-gray-600 to-gray-700 skeleton-shimmer"></span>
      </span>
    `;
  }

  // Make AJAX request with cache busting
  const cacheBuster = '&_t=' + new Date().getTime();
  const apiUrl = window.API_URL || 'api.php';
  const requestUrl = apiUrl + '?' + urlParams.toString() + cacheBuster;

  fetch(requestUrl)
    .then((response) => {
      if (!response.ok) {
        throw new Error('Network response was not ok: ' + response.status);
      }
      return response.text(); // Get as text first to debug
    })
    .then((text) => {
      try {
        return JSON.parse(text);
      } catch (e) {
        throw new Error('Invalid JSON response: ' + text.substring(0, 200));
      }
    })
    .then((data) => {
      if (data.error) {
        console.error('Server error:', data.error);
        if (imageGallery) {
          imageGallery.innerHTML =
            '<div class="w-full text-center text-white py-20 text-lg col-span-full">Server error: ' +
            escapeHtml(data.error) +
            '</div>';
        }
        return;
      }
      if (imageGallery) {
        imageGallery.innerHTML = data.html;
        // Re-observe lazy images after AJAX update
        setTimeout(() => {
          observeLazyImages();
        }, 50);
      }
      if (totalResults) {
        totalResults.textContent = data.total + ' results';

        // Trigger animation reliably
        totalResults.classList.remove('animate-fade-slide');

        // Use requestAnimationFrame to ensure the browser paints the removal
        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            totalResults.classList.add('animate-fade-slide');
          });
        });
      }

      // Update pagination controls
      updatePaginationControls(data.page || 1, data.totalPages || 1, data.total || 0);

      // Update Clear All button visibility (desktop and mobile)
      if (typeof window.updateDesktopClearAllVisibility === 'function') {
        window.updateDesktopClearAllVisibility();
      }
      if (typeof window.updateClearAllButtonVisibility === 'function') {
        window.updateClearAllButtonVisibility();
      }

      // Reinitialize image card overlays if needed
      if (typeof initializeImageCards === 'function') {
        initializeImageCards();
      }
    })
    .catch((error) => {
      console.error('Error loading images:', error);
      if (imageGallery) {
        imageGallery.innerHTML =
          '<div class="w-full text-center text-white py-20 text-lg col-span-full">Error: ' +
          escapeHtml(error.message) +
          '</div>';
      }
    });
}
