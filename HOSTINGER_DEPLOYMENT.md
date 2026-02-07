# 🚀 Hostinger Deployment - Ready to Go!

## ✅ Repository Restructured!

Your Git repository has been restructured for Hostinger. Laravel files are now at the root level.

**Repository:** https://github.com/qoritexsolutions/qoritex

---

## 📁 New Structure

```
qoritex/                              ← Root of repository
├── app/                              ← Laravel application
├── bootstrap/
├── config/
├── database/
├── public/                           ← Web root (set as document root)
├── resources/
│   └── views/
│       └── install/                  ← Installation wizard views
├── routes/
├── storage/
├── .env.example
├── artisan
├── composer.json
├── DEPLOYMENT_GUIDE.md
├── HOSTINGER_FIX.md
├── INSTALLATION_WIZARD.md
└── deploy.sh
```

**No more `techcompany` subfolder!** ✅

---

## 🎯 Deploy to Hostinger (Step by Step)

### **Step 1: Access Hostinger hPanel**

1. Go to https://www.hostinger.com
2. Log in to your account
3. Click **hPanel**

### **Step 2: Pull from GitHub**

#### **Option A: Using Git Version Control (Recommended)**

1. In hPanel, go to **Advanced** → **Git Version Control**
2. If repository exists, click **Pull**
3. If not, click **Create New Repository**:
    - **Repository URL:** `https://github.com/qoritexsolutions/qoritex.git`
    - **Branch:** `main`
    - **Repository path:** `/domains/gold-fox-800906.hostingersite.com/public_html`
    - Click **Create**

#### **Option B: Manual via SSH**

```bash
# Connect to Hostinger
ssh -p 65002 username@gold-fox-800906.hostingersite.com

# Navigate to domain
cd domains/gold-fox-800906.hostingersite.com/

# Backup existing files (if any)
mv public_html public_html_backup_$(date +%Y%m%d)

# Clone repository
git clone https://github.com/qoritexsolutions/qoritex.git public_html

# Navigate to project
cd public_html
```

### **Step 3: Set Document Root**

**CRITICAL:** Point web server to the `public` directory.

1. In hPanel, go to **Advanced** → **Domains**
2. Click **Manage** next to your domain
3. Find **Document Root**
4. Change to: **`public_html/public`**
5. Click **Save**

### **Step 4: Set Folder Permissions**

Via SSH:

```bash
cd public_html
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

Or via File Manager:

- Right-click `storage` → Permissions → 775 → Apply to subdirectories
- Right-click `bootstrap/cache` → Permissions → 775 → Apply to subdirectories

### **Step 5: Create Database**

1. In hPanel, go to **Databases** → **MySQL Databases**
2. Click **Create Database**
3. Fill in:
    - **Database name:** `u123456789_qoritex` (or your choice)
    - **Username:** `u123456789_qoritex`
    - **Password:** Create a strong password
4. Click **Create**
5. **Save these credentials** - you'll need them!

### **Step 6: Install Dependencies (Optional)**

If Composer dependencies aren't in the repository:

```bash
cd public_html
composer install --no-dev --optimize-autoloader
```

### **Step 7: Run the Installation Wizard**

1. Open your browser
2. Visit: **https://gold-fox-800906.hostingersite.com/install**
3. Follow the wizard:

    **Step 1 - Welcome**
    - Click "Get Started"

    **Step 2 - Requirements**
    - All should be green ✅
    - Click "Continue"

    **Step 3 - Database**
    - Host: `localhost`
    - Port: `3306`
    - Database: Your database name
    - Username: Your database username
    - Password: Your database password
    - Click "Test Connection & Continue"

    **Step 4 - Admin Account**
    - App Name: `Qoritex` (or your choice)
    - App URL: `https://gold-fox-800906.hostingersite.com`
    - Name: Your name
    - Email: Your email
    - Password: Create admin password
    - Click "Install Application"

    **Step 5 - Complete**
    - Installation successful! 🎉
    - Click "Admin Login"

---

## ✅ What the Installer Does Automatically

- ✅ Creates `.env` file with your settings
- ✅ Generates unique `APP_KEY`
- ✅ Tests database connection
- ✅ Runs migrations (creates tables)
- ✅ Creates admin user account
- ✅ Sets production environment
- ✅ Caches configuration
- ✅ Optimizes application
- ✅ Creates installation lock file

---

## 🔐 Post-Installation

### **Access Your Site:**

- **Frontend:** https://gold-fox-800906.hostingersite.com
- **Admin Login:** https://gold-fox-800906.hostingersite.com/login
- **Admin Dashboard:** https://gold-fox-800906.hostingersite.com/admin

### **Login Credentials:**

Use the email and password you created in Step 4 of the wizard.

### **Install SSL Certificate:**

1. In hPanel → **Security** → **SSL**
2. Click **Install** for Let's Encrypt SSL
3. Wait a few minutes
4. Your site will be https:// ✅

### **Optional: Setup Email**

Edit `.env` via File Manager or SSH:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=your-email@yourdomain.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

Then clear cache:

```bash
php artisan config:cache
```

---

## 🔄 Future Updates

When you push code changes to GitHub:

### **Via Git Version Control:**

1. Push changes to GitHub (from your local machine)
2. In Hostinger hPanel → **Git Version Control**
3. Click **Pull**
4. Done! ✅

### **Via SSH:**

```bash
cd public_html
git pull origin main
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🐛 Troubleshooting

### **404 on /install**

✅ **Fixed!** The repository structure is now correct.

- Ensure Document Root is set to `public_html/public`
- Clear browser cache

### **500 Internal Server Error**

- Check `storage/logs/laravel.log`
- Verify permissions: `chmod -R 775 storage bootstrap/cache`
- Ensure `.env` exists

### **Database Connection Error**

- Double-check database credentials
- Use `localhost` as host (not `127.0.0.1`)
- Ensure database exists in hPanel

### **Blank Page**

- Check PHP version (must be 8.1+)
- Ensure Document Root points to `public_html/public`
- Check `.htaccess` exists in `public` folder

---

## 📊 Configuration Summary

| Setting           | Value                                       |
| ----------------- | ------------------------------------------- |
| **Repository**    | https://github.com/qoritexsolutions/qoritex |
| **Branch**        | main                                        |
| **Domain**        | gold-fox-800906.hostingersite.com           |
| **Document Root** | `public_html/public`                        |
| **Database Host** | localhost                                   |
| **Database Port** | 3306                                        |
| **PHP Version**   | 8.1 or higher                               |
| **Installer URL** | /install                                    |

---

## 🎉 You're Ready!

The repository is now properly structured. Just:

1. ✅ Pull code to Hostinger
2. ✅ Set document root to `public_html/public`
3. ✅ Set permissions
4. ✅ Create database
5. ✅ Visit `/install`
6. ✅ Follow the wizard
7. ✅ Done!

**Everything else is handled automatically by the installation wizard!** 🚀

---

## 📞 Need Help?

If you encounter issues:

1. Check `storage/logs/laravel.log`
2. Verify all settings above
3. Contact Hostinger support for server-specific issues
4. Check error logs in hPanel

**Happy deploying!** 🎊
