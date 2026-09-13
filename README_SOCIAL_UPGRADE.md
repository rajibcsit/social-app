# Connectly Social App — Latest Upgrade

This package is an update of the existing Laravel social application.

## Added in this version

- Friend request badge/count on the Friends navigation item.
- Friend request count also appears in the feed sidebar.
- Post 3-dot action menu for post owners.
- Edit Post modal with body, privacy and optional replacement photo.
- Delete Post confirmation alert.
- Automatic deletion of the old post image when a replacement image is uploaded.
- Profile now shows total friends, posts and photos.
- Profile Friends section with the complete friend list.
- Profile Photos section with all posts containing photos.
- Photo preview before creating a post.
- Photo preview before editing a post.
- Avatar and Cover photo previews in Edit Profile.
- Existing Connectly admin/social modules remain included.

## Install / update

After extracting this project, run:

```bash
composer install
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

## Important

If this is being applied over an existing Connectly installation, back up your database and `storage/app/public` before replacing files.
