/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        primary: "#132c47",
        secondary: "#294c63",
        success: "#78aead",
        info: "#d4ece9",
        warning: "#fbae54",
        danger: "#d86350",
      }
    },
  },
  plugins: [

  ]
}