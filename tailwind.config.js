import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                brand: {
                    DEFAULT: '#FB2C6B',
                    light: '#FF5E91',
                    dark: '#D41B53',
                    50: '#FFF0F5',
                    100: '#FFE1EC',
                    200: '#FFB3D1',
                    300: '#FF85B6',
                    400: '#FB5793',
                    500: '#FB2C6B',
                    600: '#E61A57',
                    700: '#B81445',
                    800: '#8A0F34',
                    900: '#5C0A22',
                },
                surface: {
                    DEFAULT: '#1A1A1A',
                    50: '#2A2A2A',
                    100: '#222222',
                    200: '#1E1E1E',
                    300: '#181818',
                    400: '#141414',
                    500: '#111111',
                    600: '#0D0D0D',
                    700: '#0A0A0A',
                    800: '#070707',
                    900: '#040404',
                },
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Outfit', 'sans-serif'],
            },
            animation: {
                'fade-in': 'fadeIn 0.6s ease-out forwards',
                'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                'slide-up': 'slideUp 0.5s ease-out forwards',
                'slide-in-right': 'slideInRight 0.5s ease-out forwards',
                shimmer: 'shimmer 2s linear infinite',
                'pulse-glow': 'pulseGlow 2s ease-in-out infinite',
                float: 'float 6s ease-in-out infinite',
                'gradient-shift': 'gradientShift 8s ease infinite',
                'count-up': 'countUp 1s ease-out forwards',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(40px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideInRight: {
                    '0%': { opacity: '0', transform: 'translateX(40px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                shimmer: {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
                pulseGlow: {
                    '0%, 100%': { boxShadow: '0 0 20px rgba(251, 44, 107, 0.3)' },
                    '50%': { boxShadow: '0 0 40px rgba(251, 44, 107, 0.6)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                gradientShift: {
                    '0%, 100%': { backgroundPosition: '0% 50%' },
                    '50%': { backgroundPosition: '100% 50%' },
                },
            },
            backgroundImage: {
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                'brand-gradient': 'linear-gradient(135deg, #FB2C6B 0%, #D41B53 100%)',
                'dark-gradient': 'linear-gradient(180deg, #0A0A0A 0%, #111111 50%, #0A0A0A 100%)',
            },
            backdropBlur: {
                xs: '2px',
            },
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
                '100': '25rem',
                '120': '30rem',
            },
        },
    },

    plugins: [forms],
};
