#!/bin/bash
set -e

echo "Starting deployment..."

# 1. Fetch latest changes
echo "Fetching from git..."
git fetch
git pull

# 2. Install Dependencies
echo "Installing dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# 3. Build Assets
if [ -f "package.json" ]; then
    echo "Building assets..."
    npm install
    npm run build
fi

# 4. Run Migrations
echo "Running migrations..."
php artisan migrate --force

# 5. Clear and Cache
echo "Optimizing application..."
php artisan optimize:clear
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

# 6. Bring up application
echo "Deployment finished successfully!"
