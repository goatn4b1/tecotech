import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import daisyui from 'daisyui';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary-dark': '#064e3b',
                'success-light': '#61a83e',
            },
        },
    },

    plugins: [forms, daisyui],

    daisyui: {
        themes: [
            {
                tecotech: {
                    "primary": "#059669",
                    "secondary": "#f59e0b",
                    "accent": "#0ea04b",
                    "neutral": "#064e3b",
                    "base-100": "#ffffff",
                    "info": "#3abff8",
                    "success": "#0ea04b",
                    "warning": "#fbbd23",
                    "error": "#f87272",
                },
            },
            "light",
        ],
    },
};
