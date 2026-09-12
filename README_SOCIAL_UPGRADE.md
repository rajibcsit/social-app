# Social App — Advanced UI & Modules Update

This update builds on the existing Laravel 12 social application.

## Included
- Modern responsive Socially home/feed UI
- Feed privacy filtering (Public / Friends / Only me)
- Friend requests with Accept / Decline
- People-you-may-know suggestions
- Database notifications for friend requests, likes and comments
- Notifications page + mark read / mark all read
- Saved Posts / bookmarks
- Enhanced profile fields: bio, avatar, cover, location, website, phone
- Profile edit page with image uploads
- Online-status helper (`User::isOnline()`)
- Improved navigation and mobile-friendly styling
- Post delete, like, comment and save actions

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
npm install
npm run build
```

For local development:

```bash
php artisan serve
npm run dev
```

The project intentionally does not include `vendor/` or `node_modules/`.
