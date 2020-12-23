const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            width: {
                '7/10': '70%',
                '3/10': '30%',
            }
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        borderRadius: ['responsive', 'hover', 'focus', 'disabled', 'first', 'last'],
        border: ['responsive', 'hover', 'focus', 'disabled', 'last'],
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/postcss7-compat'),
        require('@tailwindcss/typography'),
    ],
};
