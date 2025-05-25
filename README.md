# 🌐 Service Directory App

A Laravel-powered platform that allows users to browse and filter service providers by category. Optimized for performance with caching, validation, and lazy loading!

## 💻 How It's Made:

Tech used: Laravel, Blade, PHP, Tailwind, Vite, MySQL

This app was built using the Laravel framework with a clean MVC structure. I separated business logic into a Service classes and used a custom validation class to keep the controller lean.

Providers are stored in a MySQL database and are associated with categories. A dropdown lets users filter providers by category. To enhance performance and reduce database load, both categories and provider listings are cached.

Images use native lazy loading (loading="lazy"), and Vite makes scripts deferred by default which improves initial page render times.
## ⚡ Optimizations

    🔁 Query Caching
        Categories are cached forever using Cache::rememberForever() (they rarely change), and can be handled later using observers on create/update events

        Providers are cached per category for 1 hour using Cache::remember().

    🚀 Eager Loading
        Avoided N+1 problems using Provider::with('category'). Including  Model::preventLazyLoading(true); while developing locally is preferred.

    🖼️ Lazy Loading Images
        Used the native loading="lazy" attribute for image tags to defer off-screen image loading.

    🎯 Minimal Payload
        Selected only the necessary fields in queries (select('id', 'name')) for categories.
## 🔮 Areas for Future Enhancement:

    Add pagination for large provider lists.

    Introduce search and other filtering options for more granular control.

    Expand unit and feature tests, including more negative scenarios.

    Handle caching efficiently by setting rules on when to set, forget, update, etc... the cache

    Improve on design. Currently it is minimalist to say the least.

## ⚙️ Setup Instructions
    git clone https://github.com/Mohamad-Taraboulsi/service-provider-directory.git
    cd service-directory
    composer install
    npm install
    php artisan migrate --seed
    php artisan serve && npm run dev