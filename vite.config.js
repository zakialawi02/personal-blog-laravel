import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/app-tailwind.css",
                "resources/js/app.js",
                "resources/js/wyswyg.js",
                "resources/js/app.jsx",
            ],
            refresh: ["resources/**/*"],
        }),
    ],
});
