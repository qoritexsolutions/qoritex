#!/bin/bash

# Hostinger Fix Script - Run this via SSH
# This moves Laravel files from techcompany subfolder to root

echo "🔧 Starting Hostinger deployment fix..."

# Navigate to your domain's root
cd /home/YOUR_USERNAME/domains/gold-fox-800906.hostingersite.com/

# Backup current public_html
echo "📦 Creating backup..."
mv public_html public_html_backup_$(date +%Y%m%d_%H%M%S)

# Move techcompany contents to public_html
echo "📁 Moving Laravel files..."
mv public_html_backup_*/techcompany public_html

# Navigate to Laravel root
cd public_html

# Set permissions
echo "🔒 Setting permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs
chmod -R 775 storage/framework

# Create .env from example if doesn't exist
if [ ! -f .env ]; then
    echo "⚙️ Creating .env file..."
    cp .env.example .env
fi

# Clear caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "✅ Fix completed!"
echo ""
echo "Next steps:"
echo "1. Visit: https://gold-fox-800906.hostingersite.com/install"
echo "2. Follow the installation wizard"
echo ""
echo "⚠️  Make sure to set Document Root to: public_html/public in Hostinger hPanel"
