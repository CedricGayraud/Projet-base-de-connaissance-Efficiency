/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./src/**/*.{js,jsx,ts,tsx,css}"],
    theme: {
        extend: {
            colors: {
                bleuFonce: "#364BFF",
                bleuClair: "#31ABFF",
                bleuPale: "#BAE1FE",
                vert: "#2CE6C1"
            }
        },
    },
    plugins: [],
};
