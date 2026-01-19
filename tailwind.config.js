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
                // Primary brand color - Burnt Orange for actions
                brand: {
                    DEFAULT: '#EA580C', // orange-600
                    50: '#FFF7ED',
                    100: '#FFEDD5',
                    200: '#FED7AA',
                    300: '#FDBA74',
                    400: '#FB923C',
                    500: '#F97316',
                    600: '#EA580C', // Primary brand
                    700: '#C2410C',
                    800: '#9A3412',
                    900: '#7C2D12',
                    950: '#431407',
                },
                // Informational color - Professional Blue for variety
                info: {
                    DEFAULT: '#2563EB', // blue-600
                    50: '#EFF6FF',
                    100: '#DBEAFE',
                    200: '#BFDBFE',
                    300: '#93C5FD',
                    400: '#60A5FA',
                    500: '#3B82F6',
                    600: '#2563EB', // Info blue
                    700: '#1D4ED8',
                    800: '#1E40AF',
                    900: '#1E3A8A',
                    950: '#172554',
                },
                success: {
                    DEFAULT: '#16A34A',
                    50: '#F0FDF4',
                    100: '#DCFCE7',
                    200: '#BBF7D0',
                    300: '#86EFAC',
                    400: '#4ADE80',
                    500: '#22C55E',
                    600: '#16A34A',
                    700: '#15803D',
                    800: '#166534',
                    900: '#14532D',
                    950: '#052e16',
                },
                warning: {
                    DEFAULT: '#F59E0B',
                    50: '#FFFBEB',
                    100: '#FEF3C7',
                    200: '#FDE68A',
                    300: '#FCD34D',
                    400: '#FBBF24',
                    500: '#F59E0B',
                    600: '#D97706',
                    700: '#B45309',
                    800: '#92400E',
                    900: '#78350F',
                    950: '#451a03',
                },
                danger: {
                    DEFAULT: '#DC2626',
                    50: '#FEF2F2',
                    100: '#FEE2E2',
                    200: '#FECACA',
                    300: '#FCA5A5',
                    400: '#F87171',
                    500: '#EF4444',
                    600: '#DC2626',
                    700: '#B91C1C',
                    800: '#991B1B',
                    900: '#7F1D1D',
                    950: '#450a0a',
                },
            },
            textColor: {
                primary: 'hsl(215, 30%, 15%)',
                secondary: 'hsl(215, 25%, 35%)',
                tertiary: 'hsl(215, 20%, 50%)',
                muted: 'hsl(215, 20%, 50%)',
                light: 'hsl(215, 15%, 65%)',
                inverted: 'hsl(0, 0%, 98%)',
            },
            backgroundColor: {
                soft: 'hsl(220, 20%, 98%)',
                card: 'hsl(0, 0%, 100%)',
                muted: 'hsl(220, 15%, 95%)',
            },
            borderColor: {
                light: 'hsl(220, 15%, 88%)',
                strong: 'hsl(220, 15%, 75%)',
            },
            fontFamily: {
                sans: ['Figtree', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
