/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php", 
    "./*.php",      
    "./**/*.php",
    './**/*.html',  
    "./dist/**/*.html",
  ],
  theme: {
    extend: {},
    screens: {
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
      '2xl': '1536px',
    },
    colors: {
      PrimaryBlack: '#1D1C1C',
      BorderWithoutAction: '#E0E1E2',
      green: '#0F5012',
      white: '#FEFEFE',
      delete: '#FF3A3A',
    },
  },
  plugins: [],
}

