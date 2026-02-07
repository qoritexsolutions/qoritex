#!/bin/bash

# Qoritex Deployment Script for Hostinger
# Run this script after pulling from Git

echo "🚀 Starting deployment..."

# Navigate to project directory (adjust path as needed)
cd /home/YOUR_USERNAME/domains/yourdomain.com/public_html

# If Laravel is in techcompany folder, move it up
if [ -d "techcompany" ]; then
    echo "📦 Moving Laravel files from techcompany folder..."
    cp -rn techcompany/* .
    cp -rn techcompany/.* . 2>/dev/null || true
    rm -rf techcompany
fi

# Check if .env exists, if not create from example
if [ ! -f .env ]; then
    echo "⚙️ Creating .env file from .env.example..."
    cp .env.example .env
    echo "⚠️ WARNING: Please configure your .env file with database credentials!"
fi

# Install/Update Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Generate application key if not set
if grep -q "APP_KEY=$" .env; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Set proper permissions
echo "🔒 Setting permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs
chmod -R 775 storage/framework
chmod -R 775 storage/app

# Create necessary directories if they don't exist
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Clear all caches
echo "🧹 Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize application
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Link storage (if not already linked)
if [ ! -L public/storage ]; then
    echo "🔗 Linking storage..."
    php artisan storage:link
fi

# Optional: Queue restart (if using queue workers)
# php artisan queue:restart

echo "✅ Deployment completed successfully!"
echo ""
echo "📝 Don't forget to:"
echo "   1. Configure your .env file if this is first deployment"
echo "   2. Set document root to: public_html/public"
echo "   3. Install SSL certificate"
echo ""
