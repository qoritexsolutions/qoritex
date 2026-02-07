# 🚀 HOSTINGER DEPLOYMENT - FINAL STEPS

## ✅ Code is Ready!

I've made the following changes to fix the installation issues:

### **Changes Made:**

1. ✅ **Disabled CheckInstallation Middleware** (in `bootstrap/app.php`)
    - This was blocking access to `/install`
    - Re-enable it after installation completes

2. ✅ **Created Helper Scripts** (in `public/` folder):
    - `clear-cache.php` - Clears all Laravel caches
    - `test-routes.php` - Tests if routes are loading

3. ✅ **Verified .htaccess** - Correct and working

---

## 📋 DEPLOYMENT STEPS (Do These in Order)

### **Step 1: Pull Latest Code on Hostinger**

**Via hPanel:**

1. Login to Hostinger hPanel
2. Go to **Advanced** → **Git Version Control**
3. Click **Pull** button
4. Wait for completion

**OR Via SSH:**

```bash
cd public_html
git pull origin main
```

---

### **Step 2: Run Clear Cache Script**

**Visit this URL in your browser:**

```
https://gold-fox-800906.hostingersite.com/clear-cache.php
```

This will:

- ✅ Clear all Laravel caches
- ✅ Delete bootstrap cache files
- ✅ Remove `storage/installed` file if it exists
- ✅ Give you a link to the installer

**Important:** Delete this file after use!

---

### **Step 3: Visit the Installer**

After running the cache clear script, click the link or visit:

```
https://gold-fox-800906.hostingersite.com/install
```

You should now see the **Installation Wizard!** 🎉

---

### **Step 4: Follow the Installation Wizard**

#### **Before Starting - Create Database:**

1. **hPanel** → **Databases** → **MySQL Databases**
2. Click **"Create Database"**
3. Note the credentials:
    - Database name: `u318125801_qoritex` (example)
    - Username: `u318125801_qoritex`
    - Password: (create a strong one)
    - Host: `localhost`
    - Port: `3306`

#### **Run Through Wizard:**

**Step 1 - Welcome**

- Click "Get Started"

**Step 2 - Requirements**

- All checks should pass ✅
- Click "Continue"

**Step 3 - Database**

- Enter the database credentials from above
- Click "Test Connection & Continue"
- Should say "Connection successful!" ✅

**Step 4 - Admin Account**

- App Name: `Qoritex` (or your choice)
- App URL: `https://gold-fox-800906.hostingersite.com`
- Your Name: (your name)
- Email: (your email)
- Password: (create admin password)
- Click "Install Application"

**Step 5 - Complete!**

- Installation done! 🎉
- Click "Admin Login"

---

### **Step 5: Delete Helper Scripts (Security!)**

After installation completes, delete these files via File Manager:

```
public/clear-cache.php
public/test-routes.php
```

---

### **Step 6: Re-enable CheckInstallation Middleware**

After installation, re-enable the middleware to prevent re-installation:

1. **Edit:** `bootstrap/app.php`
2. **Uncomment these lines:**

```php
// Apply installation check to web routes
// TEMPORARILY DISABLED - Enable after installation completes
// $middleware->web(append: [
//     \App\Http\Middleware\CheckInstallation::class,
// ]);
```

**Change to:**

```php
// Apply installation check to web routes
$middleware->web(append: [
    \App\Http\Middleware\CheckInstallation::class,
]);
```

3. **Save and push to Git** (or edit directly on server)

---

## 🐛 Troubleshooting

### **If /install Still Shows "Page Does Not Exist":**

1. **Run test-routes.php first:**

    ```
    https://gold-fox-800906.hostingersite.com/test-routes.php
    ```

    - Check if install routes are showing
    - If NO routes shown → Run clear-cache.php again

2. **Manually Delete Cache Files:**
    - File Manager → `bootstrap/cache/`
    - Delete all `.php` files in that folder

3. **Check for storage/installed file:**
    - File Manager → `storage/`
    - If `installed` file exists → DELETE IT

### **If Getting Database Errors:**

- Make sure you created the database in hPanel
- Use `localhost` as host (not 127.0.0.1)
- Double-check username and password

### **If Getting 500 Errors:**

- Check `storage/logs/laravel.log` for details
- Ensure permissions are 775 on `storage` and `bootstrap/cache`
- Make sure `.env` file exists with `APP_KEY`

---

## ✅ Expected Result

After following all steps:

1. ✅ `/install` shows the installation wizard
2. ✅ Database is configured automatically
3. ✅ Admin account is created
4. ✅ App is ready to use!

**Access Points:**

- **Frontend:** https://gold-fox-800906.hostingersite.com/
- **Admin Login:** https://gold-fox-800906.hostingersite.com/login
- **Admin Dashboard:** https://gold-fox-800906.hostingersite.com/admin

---

## 📞 Quick Summary

**Do these 3 things:**

1. Pull code from Git
2. Visit `clear-cache.php`
3. Visit `/install` and follow wizard

**That's it!** 🚀

---

## ⚠️ Security Reminder

After installation:

- [ ] Delete `public/clear-cache.php`
- [ ] Delete `public/test-routes.php`
- [ ] Re-enable CheckInstallation middleware
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Install SSL certificate

---

**You're ready to deploy!** Pull the code and run through these steps. Let me know if you hit any issues! 🎉
