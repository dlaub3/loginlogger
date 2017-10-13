import Typography from 'typography'

const typography = new Typography({
  baseFontSize: '18px',
  baseLineHeight: 1.666,
  headerFontFamily: ['Avenir Next', 'Helvetica Neue', 'Segoe UI', 'Helvetica', 'Arial', 'sans-serif'],
  bodyFontFamily: ['Helvetica Neue' , 'Helvetica', 'Arial', 'sans-serif'],
  // See below for the full list of options.
})

// Output CSS as string.
typography.injectStyles();
