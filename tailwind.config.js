module.exports = {
  target: 'relaxed',
  prefix: '',
  important: false,
  separator: ':',
  theme: {
    screens: {
      sm: '640px',
      md: '960px',
    },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      background: 'var(--background)',
      color: 'var(--text)',

      black: '#121317',
      white: '#fff',
      blue: '#e4edf4',
      red: 'red',

      gray: '#a6a6a6',
      'gray-light': '#bfbfbf',
      'gray-dark': '#808080',
    },
    spacing: {
      px: '1px',
      '0': '0',
      '3px': '3px',
      '5px': '5px',
      '1': '0.7rem',
      '2': '1.4rem',
      '3': '2.1rem',
      '4': '2.8rem',
      '5': '3.5rem',
    },
    fontFamily: {
      sans: ['"Helvetica Neue"', 'Helvetica', 'sans-serif'],
    },
    extend: {
      inset: {
        '1/2': '50%',
      },
    },
  },
  variants: {},
  corePlugins: {},
  plugins: [],
  purge: [
    './resources/js/**/*.js',
    './site/plugins/**/*.php',
    './site/snippets/**/*.php',
    './site/templates/**/*.php',
  ],
}
