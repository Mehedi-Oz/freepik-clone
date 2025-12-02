#!/usr/bin/env node
/**
 * Simple asset hasher
 * - Reads built files in `dist/` (output.css, script.min.js)
 * - Produces hashed filenames: output.<hash>.css, script.<hash>.js
 * - Writes `dist/asset-manifest.json` mapping original -> hashed
 * - This helps server templates reference correct filenames (use manifest at deploy time)
 */

const fs = require('fs');
const path = require('path');
const crypto = require('crypto');

function hashFile(filePath) {
  const data = fs.readFileSync(filePath);
  const hash = crypto.createHash('md5').update(data).digest('hex').slice(0, 10);
  return hash;
}

function ensureDir(dir) {
  if (!fs.existsSync(dir)) fs.mkdirSync(dir, { recursive: true });
}

(function main() {
  const dist = path.join(process.cwd(), 'dist');
  ensureDir(dist);

  const candidates = [
    { src: 'output.css', destPrefix: 'output' },
    { src: 'script.min.js', destPrefix: 'script.min' },
  ];

  const manifest = {};

  candidates.forEach((item) => {
    const srcPath = path.join(dist, item.src);
    if (!fs.existsSync(srcPath)) {
      console.warn(`Skipping missing file: ${srcPath}`);
      return;
    }

    const hash = hashFile(srcPath);
    const ext = path.extname(item.src);
    const destName = `${item.destPrefix}.${hash}${ext}`;
    const destPath = path.join(dist, destName);

    // copy (do not remove original) so existing references still work
    fs.copyFileSync(srcPath, destPath);

    manifest[item.src] = destName;
    console.log(`Created hashed asset: ${destName}`);
  });

  const manifestPath = path.join(dist, 'asset-manifest.json');
  fs.writeFileSync(manifestPath, JSON.stringify(manifest, null, 2));
  console.log(`Wrote asset manifest to ${manifestPath}`);
})();
