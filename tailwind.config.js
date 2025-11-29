/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/index.php",
    "./public/api.php",
    "./src/api/search_logic.php",
    "./src/js/script.js",
    "./includes/**/*.php",
    "./src/templates/**/*.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
