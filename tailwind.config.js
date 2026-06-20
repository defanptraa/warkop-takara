/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: "#5B913B",
        accent: "#D99D81",
        soft: "#FFE8B6",
        highlight: "#77B254",
      },
    },
  },
  plugins: [],
}

