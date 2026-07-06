/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './views/**/*.php',
    './app/**/*.php',
    './public/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        'teal-dark': '#117B7F', 'teal-mid': '#1FB6A8', 'magenta': '#A52A7E',
        'amber': '#F2A91E', 'cream': '#FCF9F5', 'ink': '#1F3334',
        background: '#FCF9F5', foreground: '#1F3334', primary: '#117B7F',
        muted: '#F1EBE1', accent: '#F2A91E',
      },
      fontFamily: {
        display: ['"Cormorant Garamond"', 'ui-serif', 'Georgia', 'serif'],
        heading: ['"Fraunces"', 'ui-serif', 'Georgia', 'serif'],
        sans: ['"Manrope"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
