# Tailwind usage — CDN (quick prototyping) and local CLI (project default)

This project compiles Tailwind locally (PostCSS + Tailwind) and serves the generated CSS from `dist/output.css`. For quick prototyping you can also use the Tailwind CDN. This document explains both approaches and shows how to switch between them.

## Which approach this repo uses (recommended)

- Local build (PostCSS + Tailwind CLI via `postcss`): this repository uses `postcss` + `tailwindcss` + `autoprefixer` to compile Tailwind from `src/css/input.css` into `dist/output.css`. The compiled file is what the app includes in production and development when you run the build/watch commands.

Why local build?
- Produces a purged, minimal stylesheet that only contains classes actually used in your templates and JS (smaller file sizes).
- Lets you use custom configuration, plugins and @layer directives.
- Works offline and is suitable for production.

Key files
- `src/css/input.css` — Tailwind entry file (contains `@tailwind base;`, `@tailwind components;`, `@tailwind utilities;` and project custom styles)
- `postcss.config.js` — loads `tailwindcss` and `autoprefixer`
- `tailwind.config.js` — content paths and custom config (colors, theme, plugins)
- `dist/output.css` — generated CSS file served by the app

Commands (PowerShell)
```powershell
cd C:\xampp\htdocs\freepik-clone
npm install        # first-time only
npm run build-css  # build Tailwind once
npm run watch-css  # rebuild on changes while developing
# full build (CSS + JS + optimize + hash):
npm run build-prod
```

How to include the generated CSS in the app
- Confirm `includes/head.php` (or the template that adds `<link>` tags) references the compiled file, e.g.:

```html
<link rel="stylesheet" href="/dist/output.css">
```

How to customize Tailwind
- Edit `tailwind.config.js` `content` array to include any additional folders or filetypes you add.
- Add custom utilities/components in `src/css/input.css` using `@layer components { ... }` or `@layer utilities { ... }`.
- Install plugins and enable them in `tailwind.config.js`.

Troubleshooting
- If you don't see changes after editing CSS, run `npm run build-css` or `npm run watch-css` and clear browser cache.
- If classes are missing in the output, add the file paths where those classes appear to the `content` array in `tailwind.config.js`.

## Tailwind CDN (quick prototyping only)

Use the CDN for fast experimentation or if you don't want to run a build step while prototyping. Do NOT use CDN in production — it will include the full Tailwind runtime (large) and you lose the benefits of purging and local customizations.

Add this inside your document `<head>` (before your markup uses classes):

```html
<!-- Tailwind Play CDN - development / prototype only -->
<script src="https://cdn.tailwindcss.com"></script>
```

Customizing the CDN build (small tweaks)
You can set a minimal config before the script runs to customize theme or enable JIT options:

```html
<script>
  window.tailwind = window.tailwind || {};
  window.tailwind.config = {
    theme: {
      extend: {
        colors: { brand: '#1c64f2' }
      }
    }
  }
</script>
<script src="https://cdn.tailwindcss.com"></script>
```

Switching from CDN to local CLI in this repo

1. Remove the CDN `<script src="https://cdn.tailwindcss.com"></script>` from your `includes/head.php` (or wherever you added it).
2. Ensure the compiled CSS is linked instead:

```html
<link rel="stylesheet" href="/dist/output.css">
```

3. Run the local build (see commands above): `npm run build-css` or `npm run watch-css` during development.

4. Confirm that `dist/output.css` contains your changes and reload the page.

## Quick examples (box/skeleton size change)

- If you're using the compiled CSS, change the class in your template (e.g. `src/templates/image-card.php`) to use Tailwind utilities for size:

```html
<!-- fixed height example -->
<div class="w-full h-56 overflow-hidden rounded-md bg-gray-100 animate-pulse">
  <img src="..." alt="..." class="w-full h-full object-cover" />
</div>

<!-- responsive heights -->
<div class="w-full h-48 sm:h-64 md:h-80 overflow-hidden rounded-md bg-gray-100 animate-pulse">
  ...
</div>
```

If you're using the CDN approach for prototyping, the same utilities apply and will be available immediately without rebuilding (but remember to switch to local build for production).

## Recommendation
- Use the local PostCSS + Tailwind build for development and production in this repo. Use the CDN only for rapid prototyping or trying a new utility on the fly.

---

If you want, I can:
- Add a short `DEVELOPMENT.md` with these commands and where to edit `includes/head.php` in this repository.
- Search the repo and update `includes/head.php` to ensure it's pointing to `dist/output.css` (I will not change it unless you ask).
