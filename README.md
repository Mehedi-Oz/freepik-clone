# Pixahunt - Premium Stock Photo Discovery Platform

Pixahunt is a modern, responsive stock photo discovery platform built as a high-fidelity clone of Freepik. It features a sophisticated filtering system, real-time search, and a premium user interface designed for seamless image exploration across all devices.

**🔴 Live Demo:** [https://test.pixahunt.com/](https://test.pixahunt.com/)

![Pixahunt Preview](assets/logo/freepik-logo.png)

## ✨ Key Features

### 🎨 Modern User Interface

- **Responsive Design**: Fully adaptive layout that works flawlessly on Desktops, Tablets, and Mobile devices.
- **Masonry Grid**: Pinterest-style image gallery layout for an immersive viewing experience.
- **Skeleton Loading**: Smooth loading states with shimmer effects for better perceived performance.
- **Dark/Light Mode**: UI prepared for theme switching (System/Light/Dark).

### 🔍 Advanced Search & Filtering

- **Real-time Search**: Instant search capabilities with keyword highlighting.
- **Smart Filters**:
  - **AI Generation**: Filter by AI-generated or Human-made content.
  - **License Type**: Free or Premium assets.
  - **Orientation**: Landscape, Portrait, or Square.
  - **Color Palette**: Filter images by dominant color (Red, Blue, Green, etc.).
  - **People**: Filter by number of people in the photo.
  - **File Type**: JPG or PNG.
- **State Persistence**: Filters and sidebar preferences are saved in `localStorage` and URL parameters for shareable links.

### 📱 Mobile Experience

- **Touch-Optimized**: Custom mobile navigation and sidebar.
- **Full-Screen Filter Overlay**: Dedicated mobile interface for complex filtering.
- **Gesture Support**: Smooth transitions and interactions.

### ⚡ Performance

- **AJAX Loading**: Seamless content updates without page reloads.
- **Lazy Loading**: Images load only when they come into the viewport.
- **Debounced Events**: Optimized resize and scroll handlers for smooth 60fps performance.

## 🛠️ Tech Stack

- **Frontend**:
  - HTML5 & Semantic Markup
  - CSS3 (Tailwind CSS via CDN)
  - Vanilla JavaScript (ES6+)
- **Backend**:
  - PHP 8.0+
  - MySQL (Database)
- **Environment**:
  - XAMPP / Apache Server

## 🚀 Installation & Setup

Since this project uses PHP and MySQL, it requires a local server environment like XAMPP, WAMP, or MAMP.

### 1. Prerequisites

- Install [XAMPP](https://www.apachefriends.org/index.html) (or equivalent).
- Ensure Apache and MySQL services are running.

### 2. Clone the Repository

Navigate to your `htdocs` directory (usually `C:\xampp\htdocs`) and clone the project:

```bash
cd C:\xampp\htdocs
git clone https://github.com/yourusername/pixahunt.git
# OR just move the project folder here
```

### 3. Database Setup

1. Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Create a new database named `pixahunt_db` (or check `db.php` for the configured name).
3. Import the provided SQL file (if available) or create the `shajal_photo_posts` table with the following structure:
   - `id` (INT, Primary Key)
   - `title` (VARCHAR)
   - `view_thumb_img` (VARCHAR) - Path to thumbnail
   - `ai_gen` (VARCHAR) - 'YES'/'NO'
   - `license` (VARCHAR)
   - `orientation` (VARCHAR)
   - `colorcode` (VARCHAR) - Hex code
   - `human` (VARCHAR) - Number of people
   - `status` (VARCHAR) - 'ACTIVE'

### 4. Configure Connection

Check `db.php` to ensure credentials match your local setup:

```php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'pixahunt_db'; // Update this if different
```

### 5. Run the Project

Open your browser and visit:
`http://localhost/Pixahunt`

## Build & Pipeline

Prerequisites:

- Node.js (v16+ recommended)
- Optional: `cwebp` (from libwebp) on PATH to enable automatic WebP conversion. Without it the build will copy assets to `dist/assets/` unchanged.

Local build steps:

```powershell
npm ci
npm run build       # builds CSS and JS
npm run optimize-assets   # converts/copies images into dist/assets
npm run hash-assets  # generates dist/asset-manifest.json with hashed names
# Or run full production build:
npm run build-prod
```

CI:

- There is a GitHub Actions workflow in `.github/workflows/ci.yml` that runs `npm ci` and `npm run build-prod` on pushes/PRs to `main` and uploads `dist/` as an artifact.

## 📂 Project Structure

```
Pixahunt/
├── assets/              # Static assets (logos, icons)
├── api.php              # AJAX endpoint for fetching images
├── db.php               # Database connection configuration
├── index.php            # Main application entry point
├── script.js            # Frontend logic (UI, AJAX, Filters)
├── search_logic.php     # Shared search/filter logic (PHP)
├── style.css            # Custom CSS overrides
└── README.md            # Project documentation
```

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
