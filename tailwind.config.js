import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: 'hsl(200, 95%, 40%)',
        secondary: 'hsl(220, 20%, 96%)',
        background: {
          DEFAULT: 'hsl(0, 0%, 100%)', // Pure white
          soft: 'hsl(220, 20%, 98%)',   // Softer alternative
          card: 'hsl(0, 0%, 100%)',   
          muted: 'hsl(220, 15%, 95%)',  // For disabled states
          dark: 'hsl(215, 30%, 9%)',   // Dark blue-gray
          'dark-soft': 'hsl(215, 28%, 10%)',
          'dark-card': 'hsl(215, 28%, 12%)',
          'dark-muted': 'hsl(215, 25%, 16%)',
        },
        text: {
          base: 'hsl(215, 30%, 15%)',        // Darker for better readability
          primary: 'hsl(215, 30%, 15%)',     // Primary text
          secondary: 'hsl(215, 25%, 35%)',   // Secondary text
          tertiary: 'hsl(215, 20%, 50%)',    // Tertiary text
          muted: 'hsl(215, 20%, 50%)',       // Muted text
          light: 'hsl(215, 15%, 65%)',       // Light text
          inverted: 'hsl(0, 0%, 98%)',    // For dark backgrounds
          'dark-base': 'hsl(0, 0%, 98%)',     // Dark mode base text
          'dark-primary': 'hsl(0, 0%, 98%)',  // Dark mode primary
          'dark-secondary': 'hsl(0, 0%, 90%)', // Dark mode secondary
          'dark-tertiary': 'hsl(215, 15%, 65%)',  // Dark mode tertiary
          'dark-muted': 'hsl(215, 15%, 65%)',     // Dark mode muted
          'dark-light': 'hsl(215, 15%, 50%)',     // Dark mode light
        },
        border: {
          light: 'hsl(220, 15%, 88%)',      // Light border
          DEFAULT: 'hsl(220, 15%, 88%)',    // Default border
          strong: 'hsl(220, 15%, 75%)',     // Stronger border
          dark: 'hsl(215, 25%, 18%)',       // Dark mode default
          'dark-light': 'hsl(215, 25%, 16%)', // Dark mode light
          'dark-strong': 'hsl(215, 25%, 25%)', // Dark mode strong
        },
        // Status colors for better UI feedback
        success: {
          50: 'hsl(150, 60%, 96%)',
          500: 'hsl(150, 60%, 50%)',
          600: 'hsl(150, 60%, 45%)',
          700: 'hsl(150, 60%, 40%)'
        },
        warning: {
          50: 'hsl(45, 100%, 96%)',
          500: 'hsl(45, 100%, 51%)',
          600: 'hsl(45, 100%, 47%)',  
          700: 'hsl(45, 100%, 42%)'
        },
        danger: {
          50: 'hsl(0, 90%, 96%)',
          500: 'hsl(0, 90%, 55%)',
          600: 'hsl(0, 90%, 50%)',
          700: 'hsl(0, 90%, 45%)'
        },
        info: {
          50: 'hsl(200, 95%, 96%)',
          500: 'hsl(200, 95%, 50%)',
          600: 'hsl(200, 95%, 45%)',
          700: 'hsl(200, 95%, 40%)'
        },
        accent: {
          DEFAULT: 'hsl(30, 100%, 50%)',
          50: 'hsl(30, 100%, 95%)',
          500: 'hsl(30, 100%, 50%)',
          600: 'hsl(30, 100%, 45%)',
          700: 'hsl(30, 100%, 40%)',
          dark: 'hsl(30, 100%, 55%)',
        }
      },
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },

    plugins: [forms],
};
