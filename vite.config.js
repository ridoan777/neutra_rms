import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/flowbite_custom.css', 'resources/css/neutra_invoice.css', 'resources/js/flowbite.js', 'resources/js/jquery-3.7.1-min.js' ,'resources/js/app.js'],
            refresh: true,
        }),
    ],
});