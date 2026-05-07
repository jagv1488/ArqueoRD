import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        // Asegúrate de incluir los componentes de Livewire si decides crear vistas separadas
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                // Paleta extraída del logo y maqueta de ArqueoRD
                terracota: '#C56A3D',
                earth: '#8B5A2B',
                sand: '#F7EFE2',
                clay: '#A65D3A',
                stone: '#6B5E4A',
                deepblue: '#1F4E6E',
                skyblue: '#4A90B0',
            },
        },
    },

    plugins: [forms],
};
