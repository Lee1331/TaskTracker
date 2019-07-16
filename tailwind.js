module.exports = {

    theme: {
        // extend: {},
        shadows: {
            default: '0 0 5px 0 rgba(0, 0, 0, 0.08)',
        },
        colors: {
            'white': '#FFFFFF',
            'grey-light': '#F5F6F9',
            grey: 'rgba(0, 0, 0, 0.4)',
            blue: '#47CDFF'
        },
    },
    variants: {},
    plugin: [
        // ...
        require('tailwindcss')('tailwind.js'),
        require('autoprefixer'),
        // ...
    ]
}
