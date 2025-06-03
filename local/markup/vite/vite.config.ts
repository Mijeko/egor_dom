import {defineConfig} from 'vite';
import vue from '@vitejs/plugin-vue';

// https://vite.dev/config/
export default defineConfig({
    plugins: [vue()],
    build: {
        // outDir: '../local/templates/main/dist',
        manifest: true,
    },
    server: {
        host: true,
        port: 27000,
    }
})
