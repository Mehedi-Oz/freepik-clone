<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?></title>

  <?php
  include_once __DIR__ . '/../src/helpers/asset.php'; ?>

  <!-- Tailwind CSS (Production Build) -->
  <link rel="stylesheet" href="<?php echo asset_url('output.css'); ?>">

  <!-- all links -->
  <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/src/css/style.css">

  <script>
    (function() {
      try {
        // Sidebar logic - only apply on desktop
        var isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        var isDesktop = window.innerWidth >= 1280;

        if (isCollapsed && isDesktop) {
          var style = document.createElement('style');
          style.id = 'sidebar-fouc-style';
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
          var mobileLogo = document.createElement('style');
          mobileLogo.id = 'mobile-logo-style';
          mobileLogo.innerHTML = `
            header img { display: block !important; }
          `;
          document.head.appendChild(mobileLogo);
        }

        // Filter bar logic
        var isFilterOpen = localStorage.getItem('filterDropdownOpen') === 'true';
        if (!isFilterOpen) {
          var filterStyle = document.createElement('style');
          filterStyle.id = 'filter-fouc-style';
          filterStyle.innerHTML = `
             #filters-section { display: none !important; }
           `;
          document.head.appendChild(filterStyle);
        } else {
          var filterStyle = document.createElement('style');
          filterStyle.id = 'filter-fouc-style';
          filterStyle.innerHTML = `
             .chevron { transform: rotate(180deg) !important; transform-origin: center !important; }
           `;
          document.head.appendChild(filterStyle);
        }
      } catch (e) {}
    })();
  </script>

  <!-- Set base path for JavaScript -->
  <script>
    window.BASE_PATH = '<?php echo BASE_PATH; ?>';
    window.API_URL = '<?php echo BASE_PATH; ?>/public/api.php';
    window.ENVIRONMENT = '<?php echo ENVIRONMENT; ?>';
  </script>
</head>
