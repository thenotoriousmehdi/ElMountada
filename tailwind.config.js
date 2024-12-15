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
    extend: {
      screens: {
        sm: '640px',
        md: '768px',
        lg: '1024px',
        xl: '1280px',
        '2xl': '1536px',
      },
      colors: {
        text: '#264653',
          bg2: '#E9C46A',
          primary: '#E76F51',
          bg: '#F4F1DE',
          principale: '#2A2A2A',
      },
    },
    
  },
  plugins: [],
}

