/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './**/*.html',
    './src/js/**/*.js',
    './src/templates/**/*.php',
    '!./node_modules/**',
    '!./dist/**',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
