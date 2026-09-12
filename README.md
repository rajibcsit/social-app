# Laravel Social — Facebook-style Starter

A full-featured Laravel + Blade + Tailwind CSS social media application starter.

## Included
- Authentication-ready structure (Laravel Breeze recommended)
- Feed/posts with text, image and privacy
- Likes, comments, shares
- User profiles, cover/avatar upload
- Friend requests and friend list
- Notifications
- Search
- Groups-ready navigation
- Responsive Facebook-style UI
- MySQL migrations/models/controllers
- Tailwind CSS + Vite

## Install
1. Create a fresh Laravel application:
   `composer create-project laravel/laravel social-app`
2. Copy this package's `app`, `database`, `resources`, `routes`, `public` and config files into it.
3. Install auth:
   `composer require laravel/breeze --dev`
   `php artisan breeze:install blade`
4. Install frontend:
   `npm install`
   `npm install -D tailwindcss @tailwindcss/vite`
5. Configure `.env` for MySQL.
6. Run:
   `php artisan migrate`
   `php artisan storage:link`
   `npm run dev`
   `php artisan serve`

This archive is a source-code starter designed to be placed into a fresh Laravel project so it remains compatible with current Laravel versions.
