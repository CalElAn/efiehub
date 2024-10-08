const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/components/**/*.vue',
        './resources/js/components/*.vue',
        './resources/js/Pages/**/*.vue',
        './resources/js/Pages/*.vue',
        './resources/js/Shared/**/*.vue',
        './resources/js/Shared/*.vue',
    ],

    theme: {
        container: {
            center: true,
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                Poppins: ['Poppins','Nunito', 'sans-serif'],
            }, 
            screens: {
                '3xl': '2560px',
            },
            colors: {
                'main-blue': '#4568ED',
                'main-orange': '#FF5B1A',
            },
            borderRadius: {
                'main-card': '2.5rem',
                'header-bg-min': '3.75rem',
            },
            height: {
                'header-img': '33rem',
                'header-bg': '30rem',
                'header-bg-min': '75vh',
                'become-an-agent-card-max': '549px',
            },
            width: {
                'header-img': '50vw',
                'searchbar-max': '60vw',
                'searchbar-md': '70vw',
                'searchbar-2x': '33vw',
            },
            backgroundImage: {
                'become-an-agent': "url('/images/become-an-agent.png')",
                'become-an-agent-2x': "url('/images/become-an-agent-2x.png')",
                'logo': "url('/images/logo.png')",
                'logo-blue': "url('/images/logo-blue.png')",
            },
            inset: {
                '0.1': '10%',
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            placeholderColor: ['hover', 'group-hover'],
            borderStyle: ['hover', 'focus'],
            textColor: ['group-focus'],
            borderWidth: ['hover',],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
