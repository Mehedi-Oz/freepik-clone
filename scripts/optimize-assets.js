#!/usr/bin/env node
/*
 Simple asset optimizer helper.
 - Scans `assets/` for .jpg/.jpeg/.png files and attempts to convert to .webp using `cwebp` (if available).
 - Writes output to `dist/assets/` preserving subfolders.
 - Falls back to printing actionable instructions if `cwebp` is not installed.

This avoids adding heavy npm native deps in the repo; if you want an npm-native solution we can add `sharp` or `imagemin` later.
*/

const { execSync, spawnSync } = require('child_process');
const fs = require('fs');
const path = require('path');

function ensureDir(dir) {
  if (!fs.existsSync(dir)) fs.mkdirSync(dir, { recursive: true });
}

function hasCwebp() {
  try {
    const res = spawnSync('cwebp', ['-version'], { stdio: 'ignore' });
    return res.status === 0 || res.status === null;
  } catch (e) {
    return false;
  }
}

function scanAndConvert(srcDir, outDir) {
  const entries = fs.readdirSync(srcDir, { withFileTypes: true });
  for (const ent of entries) {
    const srcPath = path.join(srcDir, ent.name);
    const relPath = path.relative('assets', srcPath);
    const destPathDir = path.join(outDir, path.dirname(relPath));
    ensureDir(destPathDir);

    if (ent.isDirectory()) {
      scanAndConvert(srcPath, outDir);
    } else if (ent.isFile()) {
      const ext = path.extname(ent.name).toLowerCase();
      if (ext === '.jpg' || ext === '.jpeg' || ext === '.png') {
        const destWebp = path.join(destPathDir, path.basename(ent.name, ext) + '.webp');
        console.log(`Converting ${srcPath} -> ${destWebp}`);
        try {
          // cwebp -q 75 input -o output
          execSync(`cwebp -q 75 "${srcPath}" -o "${destWebp}"`, { stdio: 'inherit' });
        } catch (e) {
          console.error('Failed to convert with cwebp:', e.message || e);
        }
      } else {
        // copy other assets as-is
        const dest = path.join(destPathDir, ent.name);
        fs.copyFileSync(srcPath, dest);
      }
    }
  }
}

(function main() {
  const srcAssets = path.join(process.cwd(), 'assets');
  const outAssets = path.join(process.cwd(), 'dist', 'assets');

  if (!fs.existsSync(srcAssets)) {
    console.log('No assets/ directory found — nothing to optimize.');
    return;
  }

  ensureDir(outAssets);

  if (!hasCwebp()) {
    console.warn('\n`cwebp` tool not found on PATH.');
    console.warn('Install it to enable automatic WebP conversion, or run a manual optimizer.');
    console.warn('\nOptions:');
    console.warn(' - macOS: `brew install webp`');
    console.warn(' - Windows: install libwebp and ensure `cwebp.exe` is on PATH');
    console.warn(' - Or add an npm-native pipeline with `sharp` or `imagemin`');
    console.warn('\nCopying assets to dist/assets without conversion...');
    // Copy all files recursively
    scanAndConvert(srcAssets, outAssets);
    return;
  }

  console.log('cwebp found — converting images to WebP and copying other assets...');
  scanAndConvert(srcAssets, outAssets);
  console.log('\nAsset optimization complete. Review `dist/assets/` and verify file sizes.');
})();
