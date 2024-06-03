import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.jsx",
    ],

    theme: {
        screens: {
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1280px",
            "2xl": "1440px",
            "3xl": "1600px",
        },
        extend: {
            container: {
                center: true,
                padding: "2rem",
            },

            fontFamily: {
                Poppins: ["Poppins", "sans-serif"],
                Lato: ["Lato", "sans-serif"],
            },
            colors: {
                primary: "#2e62af",
                secondary: "#162f55",
                accent: "#ca8a04",
                neutral: "#ded9da",
                "base-100": "#f2f2f2",
                info: "#aea679",
                success: "#31A640",
                warning: "#EDAE49",
                error: "#D1495B",
                light: "#fafbfc",
                dark: "#02132B",
                muted: "#767676",
            },
        },
    },

    plugins: [forms, typography],
};
