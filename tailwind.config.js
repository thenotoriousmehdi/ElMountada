/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",  // Adjust path based on your file structure
    "./*.php",       // Include PHP files in the root
    "./**/*.php",    // Include PHP files in all subdirectories (if applicable)
    "./dist/**/*.html",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

