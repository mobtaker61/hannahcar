import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Livewire/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#1A2243',
        accent: '#F2A024',
        surface: '#F5F5F5',
        'secondary-text': '#2E2E2E',
      },
      fontFamily: {
        sans: ['Vazirmatn', 'Figtree', 'system-ui', 'sans-serif'],
        'persian': ['Vazirmatn', 'Tahoma', 'Arial', 'sans-serif'],
        'english': ['Figtree', 'system-ui', 'sans-serif'],
      },
      animation: {
        'slide-up': 'slideUp 0.6s ease-out',
        'fade-in': 'fadeIn 0.5s ease-out',
        'bounce-in': 'bounceIn 0.6s ease-out',
      },
      keyframes: {
        slideUp: {
          '0%': { transform: 'translateY(30px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        bounceIn: {
          '0%': { transform: 'scale(0.3)', opacity: '0' },
          '50%': { transform: 'scale(1.05)' },
          '70%': { transform: 'scale(0.9)' },
          '100%': { transform: 'scale(1)', opacity: '1' },
        },
      },
      spacing: {
        '18': '4.5rem',
        '88': '22rem',
        '128': '32rem',
      },
      borderRadius: {
        '4xl': '2rem',
      },
      boxShadow: {
        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
        'medium': '0 4px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
        'large': '0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 2px 10px -2px rgba(0, 0, 0, 0.05)',
      },
      backdropBlur: {
        xs: '2px',
      },
      lineHeight: {
        'extra-tight': '1.15',
        'extra-loose': '2.25',
      },
      fontSize: {
        '2xs': '0.625rem',
      },
      zIndex: {
        '60': '60',
        '70': '70',
        '80': '80',
        '90': '90',
        '100': '100',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
    // RTL Support Plugin
    function({ addUtilities, theme }) {
      const rtlUtilities = {
        '.rtl': {
          direction: 'rtl',
        },
        '.ltr': {
          direction: 'ltr',
        },
        '.rtl-flip': {
          transform: 'scaleX(-1)',
        },
        '.rtl-mirror': {
          transform: 'scaleX(-1)',
        },
        // RTL spacing utilities
        '.space-x-reverse': {
          '--tw-space-x-reverse': '1',
        },
        '.space-y-reverse': {
          '--tw-space-y-reverse': '1',
        },
        // RTL text alignment
        '.text-start': {
          'text-align': 'start',
        },
        '.text-end': {
          'text-align': 'end',
        },
        // RTL positioning
        '.start-0': {
          'inset-inline-start': '0',
        },
        '.end-0': {
          'inset-inline-end': '0',
        },
        '.start-1': {
          'inset-inline-start': '0.25rem',
        },
        '.end-1': {
          'inset-inline-end': '0.25rem',
        },
        '.start-2': {
          'inset-inline-start': '0.5rem',
        },
        '.end-2': {
          'inset-inline-end': '0.5rem',
        },
        '.start-3': {
          'inset-inline-start': '0.75rem',
        },
        '.end-3': {
          'inset-inline-end': '0.75rem',
        },
        '.start-4': {
          'inset-inline-start': '1rem',
        },
        '.end-4': {
          'inset-inline-end': '1rem',
        },
        // RTL margin
        '.ms-auto': {
          'margin-inline-start': 'auto',
        },
        '.me-auto': {
          'margin-inline-end': 'auto',
        },
        '.ms-0': {
          'margin-inline-start': '0',
        },
        '.me-0': {
          'margin-inline-end': '0',
        },
        '.ms-1': {
          'margin-inline-start': '0.25rem',
        },
        '.me-1': {
          'margin-inline-end': '0.25rem',
        },
        '.ms-2': {
          'margin-inline-start': '0.5rem',
        },
        '.me-2': {
          'margin-inline-end': '0.5rem',
        },
        '.ms-3': {
          'margin-inline-start': '0.75rem',
        },
        '.me-3': {
          'margin-inline-end': '0.75rem',
        },
        '.ms-4': {
          'margin-inline-start': '1rem',
        },
        '.me-4': {
          'margin-inline-end': '1rem',
        },
        // RTL padding
        '.ps-0': {
          'padding-inline-start': '0',
        },
        '.pe-0': {
          'padding-inline-end': '0',
        },
        '.ps-1': {
          'padding-inline-start': '0.25rem',
        },
        '.pe-1': {
          'padding-inline-end': '0.25rem',
        },
        '.ps-2': {
          'padding-inline-start': '0.5rem',
        },
        '.pe-2': {
          'padding-inline-end': '0.5rem',
        },
        '.ps-3': {
          'padding-inline-start': '0.75rem',
        },
        '.pe-3': {
          'padding-inline-end': '0.75rem',
        },
        '.ps-4': {
          'padding-inline-start': '1rem',
        },
        '.pe-4': {
          'padding-inline-end': '1rem',
        },
        '.ps-8': {
          'padding-inline-start': '2rem',
        },
        '.pe-8': {
          'padding-inline-end': '2rem',
        },
        '.ps-10': {
          'padding-inline-start': '2.5rem',
        },
        '.pe-10': {
          'padding-inline-end': '2.5rem',
        },
        '.ps-12': {
          'padding-inline-start': '3rem',
        },
        '.pe-12': {
          'padding-inline-end': '3rem',
        },
        // RTL border radius
        '.rounded-s-lg': {
          'border-start-start-radius': '0.5rem',
          'border-end-start-radius': '0.5rem',
        },
        '.rounded-e-lg': {
          'border-start-end-radius': '0.5rem',
          'border-end-end-radius': '0.5rem',
        },
        '.rounded-s-md': {
          'border-start-start-radius': '0.375rem',
          'border-end-start-radius': '0.375rem',
        },
        '.rounded-e-md': {
          'border-start-end-radius': '0.375rem',
          'border-end-end-radius': '0.375rem',
        },
        '.rounded-s': {
          'border-start-start-radius': '0.25rem',
          'border-end-start-radius': '0.25rem',
        },
        '.rounded-e': {
          'border-start-end-radius': '0.25rem',
          'border-end-end-radius': '0.25rem',
        },
        // RTL specific utilities
        '.rtl-text-right': {
          'text-align': 'right',
        },
        '.rtl-text-left': {
          'text-align': 'left',
        },
        '.rtl-float-right': {
          'float': 'right',
        },
        '.rtl-float-left': {
          'float': 'left',
        },
        '.rtl-clear-right': {
          'clear': 'right',
        },
        '.rtl-clear-left': {
          'clear': 'left',
        },
      };

      addUtilities(rtlUtilities);
    },
  ],
}
