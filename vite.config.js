import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.css',
                // 'resources/js/jquery.js',
                // 'resources/js/jquery-ui.js'
            ],
            refresh: true,
        }),
    ],
});
