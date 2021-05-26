const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/components/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        screens: {
            'sm': '560px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1280px',
            '2xl': '1536px',
          }
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
