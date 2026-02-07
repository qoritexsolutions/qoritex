# Installation Wizard

This Laravel application includes a built-in installation wizard that makes deployment simple and user-friendly.

## Features

✨ **Smart Installation Wizard**

- 🎯 Step-by-step guided installation
- ✅ Server requirements validation
- 🔌 Database connection testing
- 👤 Admin account creation
- 🔒 Automatic security configuration

## Installation Steps

### 1. Upload Files to Server

Upload all files to your web server's document root (usually `public_html` or similar).

### 2. Set Permissions

Ensure the following directories are writable:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 3. Access the Installer

Navigate to your domain in a web browser:

```
https://yourdomain.com/install
```

### 4. Follow the Wizard

The installer will guide you through 5 steps:

#### Step 1: Welcome

- Review prerequisites and requirements

#### Step 2: Requirements Check

- Automatic validation of:
    - PHP version (>= 8.1)
    - Required PHP extensions
    - Folder permissions

#### Step 3: Database Configuration

- Enter your database credentials:
    - Host (usually `localhost`)
    - Port (usually `3306`)
    - Database name
    - Username
    - Password
- Connection is automatically tested

#### Step 4: Admin Account

- Configure application settings:
    - Application name
    - Application URL
- Create administrator account:
    - Full name
    - Email address
    - Password

#### Step 5: Complete

- Installation finishes automatically:
    - ✅ Environment file created
    - ✅ Application key generated
    - ✅ Database tables created
    - ✅ Admin user created
    - ✅ Configuration cached

## What Gets Configured

The installer automatically handles:

1. **Environment Configuration** (`.env`)
    - Database settings
    - Application name and URL
    - Production mode enabled
    - Debug mode disabled

2. **Database Setup**
    - Runs all migrations
    - Creates necessary tables
    - Sets up relationships

3. **Security**
    - Generates unique APP_KEY
    - Creates admin user with encrypted password
    - Sets secure defaults

4. **Optimization**
    - Caches configuration
    - Caches routes
    - Caches views
    - Links storage directory

## Post-Installation

After installation completes:

1. **Access Your Site**
    - Frontend: `https://yourdomain.com`
    - Admin Panel: `https://yourdomain.com/admin`

2. **Login Credentials**
    - Use the email and password you created during installation

3. **Additional Configuration**
    - Set up email in `.env` file:
        ```env
        MAIL_MAILER=smtp
        MAIL_HOST=your-smtp-host
        MAIL_PORT=587
        MAIL_USERNAME=your-email
        MAIL_PASSWORD=your-password
        ```

4. **Security Recommendations**
    - Install SSL certificate
    - Set up regular backups
    - Review file permissions
    - Keep Laravel updated

## Re-installation

The installer creates a lock file (`storage/installed`) to prevent accidental re-installation.

To reinstall:

1. Delete `storage/installed`
2. Clear your `.env` file or reset database credentials
3. Visit `/install` again

⚠️ **Warning:** Re-installation will drop existing data!

## Troubleshooting

### Cannot Access Installer

- Check file permissions
- Ensure `.htaccess` is uploaded (if using Apache)
- Verify PHP version is 8.1+

### Database Connection Failed

- Verify database credentials
- Ensure database exists
- Check if MySQL is running
- Try using `127.0.0.1` instead of `localhost`

### 500 Internal Server Error

- Check `storage/logs/laravel.log`
- Verify folder permissions
- Enable display errors temporarily in `.env`:
    ```env
    APP_DEBUG=true
    ```

### Installation Stuck

- Clear browser cache
- Check server error logs
- Ensure all required PHP extensions are installed

## Manual Installation

If you prefer manual installation:

1. Copy `.env.example` to `.env`
2. Configure database settings in `.env`
3. Run:
    ```bash
    php artisan key:generate
    php artisan migrate
    php artisan db:seed  # If you have seeders
    ```

## Technical Details

### Files Created

- `app/Http/Controllers/InstallController.php` - Installation logic
- `app/Http/Middleware/CheckInstallation.php` - Installation status check
- `resources/views/install/*.blade.php` - Installer UI
- `storage/installed` - Installation lock file

### Routes

All installer routes are prefixed with `/install`:

- `/install` - Welcome page
- `/install/requirements` - Requirements check
- `/install/database` - Database configuration
- `/install/admin` - Admin account creation
- `/install/complete` - Completion page

## Support

For issues or questions:

- Check `storage/logs/laravel.log` for errors
- Review server error logs
- Ensure all prerequisites are met
- Contact your hosting provider for server-specific issues

---

**Ready to install?** Visit `/install` in your browser to get started! 🚀
