# Qoritex - Hostinger Deployment Guide

## Prerequisites

- Hostinger Business Hosting account
- SSH access enabled
- Domain configured
- MySQL database created

---

## Method 1: Deploy via Hostinger Git (Recommended)

### Step 1: Access Hostinger hPanel

1. Go to https://www.hostinger.com and log in
2. Click on **hPanel**

### Step 2: Create MySQL Database

1. Go to **Databases** → **MySQL Databases**
2. Click **Create Database**
3. Database Name: `qoritex_db` (or your preferred name)
4. Username: `qoritex_user`
5. Password: Create a strong password
6. **Save these credentials** - you'll need them!

### Step 3: Set Up Git Repository

1. Go to **Advanced** → **Git Version Control**
2. Click **"Create New Repository"**
3. Fill in:
   - **Repository URL**: `https://github.com/qoritexsolutions/qoritex.git`
   - **Branch**: `main`
   - **Repository path**: `/domains/yourdomain.com/public_html`
4. Click **"Create"** and wait for cloning to complete

### Step 4: Configure Laravel Application

After Git clones, you need to configure Laravel:

#### A. Access File Manager

1. In hPanel, go to **Files** → **File Manager**
2. Navigate to your domain's `public_html` directory

#### B. Move Laravel Files

Since your Laravel app is in the `techcompany` folder:

1. Select all files/folders inside `techcompany/`
2. Move them to `public_html/` (one level up)
3. Delete the empty `techcompany` folder

#### C. Set Up .env File

1. Copy `.env.example` to `.env`
2. Edit `.env` with these settings:

```env
APP_NAME=Qoritex
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=qoritex_db
DB_USERNAME=qoritex_user
DB_PASSWORD=your_database_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

FILESYSTEM_DISK=public
```

### Step 5: Configure via SSH (Required for artisan commands)

#### A. Access SSH

1. In hPanel, go to **Advanced** → **SSH Access**
2. Note your credentials:
   - Host: Provided by Hostinger
   - Port: Usually `65002`
   - Username: Your hosting username
   - Password: Your hosting password

#### B. Connect via SSH

Open PowerShell on your local machine and run:

```bash
ssh -p 65002 your_username@your_host
```

#### C. Navigate to Your Project

```bash
cd domains/yourdomain.com/public_html
```

#### D. Install Dependencies

```bash
composer install --no-dev --optimize-autoloader
```

#### E. Generate Application Key

```bash
php artisan key:generate
```

#### F. Set Permissions

```bash
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs
chmod -R 775 storage/framework
```

#### G. Run Migrations

```bash
php artisan migrate --force
```

#### H. Cache Configuration

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### I. Link Storage

```bash
php artisan storage:link
```

### Step 6: Configure Document Root

**IMPORTANT**: Laravel's public directory should be the web root.

1. In hPanel, go to **Advanced** → **Domains**
2. Find your domain and click **Manage**
3. Under **Document Root**, set it to: `public_html/public`
4. Save changes

---

## Method 2: Manual SSH Clone & Deploy

### Step 1: Connect via SSH

```bash
ssh -p 65002 your_username@your_host
```

### Step 2: Navigate to Web Directory

```bash
cd domains/yourdomain.com
```

### Step 3: Backup Current Files (if any)

```bash
mv public_html public_html_backup
```

### Step 4: Clone Repository

```bash
git clone https://github.com/qoritexsolutions/qoritex.git temp_clone
mv temp_clone/techcompany public_html
rm -rf temp_clone
cd public_html
```

### Step 5: Install Dependencies

```bash
composer install --no-dev --optimize-autoloader
```

### Step 6: Configure Environment

```bash
cp .env.example .env
nano .env  # Edit with your database credentials
```

### Step 7: Generate App Key

```bash
php artisan key:generate
```

### Step 8: Set Permissions

```bash
chmod -R 755 storage bootstrap/cache
find storage -type f -exec chmod 664 {} \;
find storage -type d -exec chmod 775 {} \;
```

### Step 9: Run Migrations

```bash
php artisan migrate --force
```

### Step 10: Optimize Application

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```

---

## Post-Deployment Checklist

- [ ] Database connection working
- [ ] .env file configured correctly
- [ ] APP_KEY generated
- [ ] Storage permissions set
- [ ] Migrations run successfully
- [ ] Document root points to `/public`
- [ ] SSL certificate installed (use Hostinger's free SSL)
- [ ] Cache cleared and optimized

---

## Updating Your Application

When you push updates to GitHub:

### Via Hostinger Git:

1. Go to **Git Version Control** in hPanel
2. Click **"Pull"** next to your repository
3. Run deployment script or manually run:

```bash
composer install --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Via SSH:

```bash
cd domains/yourdomain.com/public_html
git pull origin main
composer install --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Troubleshooting

### 500 Internal Server Error

1. Check `.env` file exists and is configured
2. Ensure storage permissions: `chmod -R 775 storage`
3. Clear cache: `php artisan cache:clear`
4. Check error logs in `storage/logs/laravel.log`

### Database Connection Error

1. Verify database credentials in `.env`
2. Ensure database and user exist in hPanel
3. Use `localhost` as DB_HOST

### Permission Denied

```bash
chmod -R 755 storage bootstrap/cache
chown -R your_username:your_username storage bootstrap/cache
```

### Composer Not Found

Most Hostinger plans have composer. If not:

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
alias composer='php composer.phar'
```

---

## Support

- Hostinger Support: https://www.hostinger.com/tutorials
- Laravel Docs: https://laravel.com/docs

---

## Security Notes

1. Set `APP_DEBUG=false` in production
2. Keep your `.env` file secure (should not be in Git)
3. Regularly update dependencies: `composer update`
4. Enable Hostinger's SSL certificate
5. Set strong database passwords
