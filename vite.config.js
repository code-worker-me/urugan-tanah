import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Mengizinkan akses dari luar container
        port: 5173,      // Memastikan port terkunci di 5173
        hmr: {
            host: 'localhost', // Browser Anda akan mengakses HMR lewat localhost
        },
        watch: {
            usePolling: true, // Wajib di Docker agar perubahan file di Windows/Mac terdeteksi
        },
    },
});