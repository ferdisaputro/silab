import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/**/**/*.blade.php',
        './resources/views/**/**/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    darkMode: 'selector',

    theme: {
        colors: {
            primaryBlack: '#222831',
            primaryGrey: '#EEEEEE',
            primaryTeal: '#00ADB5',
            primaryDark: '#393E46'
        },
        extend: {
            fontFamily: ["Inter", "Roboto", "sans-serif"],
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin')({
            datatables: true,
        }),
    ],
};
