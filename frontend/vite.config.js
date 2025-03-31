import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({

            input: ['resources/css/app.css', 'resources/scss/freead.scss','resources/scss/layout.scss','resources/scss/userLoging.scss','resources/scss/homePage.scss','resources/scss/userProfile.scss','resources/scss/adminDashboard.scss','resources/scss/footer.scss','resources/scss/productPage1.scss','resources/scss/sideNavBar.scss','resources/scss/aboutUs.scss','resources/scss/app.scss','resources/js/app.js'],
            refresh: true,
        }),
    ],
});
