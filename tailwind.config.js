import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';


/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        fontFamily: {
            'inter': ['Inter', 'sans-serif'],
        },
        extend: {
            colors: {
                cblack: "#17252A",
                cdeep: "#2B7A78",
                cgreen: "#3AAFA9",
                cgrey: "#DEF2F1",
                cwhite: "#FEFFFF",
              },
        },
    },

    plugins: [forms],
};
