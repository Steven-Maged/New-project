import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // ملف Tailwind CSS
                'resources/js/app.js',  // ملف JavaScript
                'node_modules/bootstrap/dist/css/bootstrap.min.css', // ملف CSS الخاص بـ Bootstrap
                'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js' // ملف JavaScript الخاص بـ Bootstrap
            ],
            refresh: true,
        }),
    ],
});
