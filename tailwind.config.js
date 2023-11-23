module.exports = {
  content: ['./resources/views/**/*.blade.php'],
  mode: 'jit',
  theme: {
    extend: {
      colors: {
        // primary: '#7E22CE',
        // primary: '#2299dd',
        primary: '#00bf71',
        light: '#ffffff',
        // dark: '#162131',
        // secondary: '#adb2ba',
        dark: '#333',
        secondary: '#949494'
      },
    },
    screens: {
      xs: '480px',
      ss: '620px',
      sm: '768px',
      md: '1060px',
      lg: '1200px',
      xl: '1700px',
    },
  },
  plugins: [],
}