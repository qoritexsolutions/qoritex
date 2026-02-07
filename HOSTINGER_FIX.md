# Hostinger Deployment Fix Guide

## Problem

Your Laravel app is in the `techcompany` subfolder, but the web server doesn't know where to find it.

**Current URL:** https://gold-fox-800906.hostingersite.com/install  
**Error:** Page does not exist

---

## Solution: Fix via Hostinger File Manager (No SSH Required)

### **Step 1: Access File Manager**

1. Log in to **Hostinger hPanel**
2. Go to **Files** → **File Manager**
3. Navigate to `domains/gold-fox-800906.hostingersite.com/public_html`

### **Step 2: Move Laravel Files**

**Current structure:**

```
public_html/
  └── techcompany/         ← Your Laravel app
      ├── app/
      ├── public/
      ├── routes/
      └── ...
```

**What to do:**

1. **Select ALL files/folders** inside the `techcompany` folder
2. **Cut** them (or Copy)
3. Go **up one level** to `public_html`
4. **Paste** all files there
5. **Delete** the empty `techcompany` folder

**Result:**

```
public_html/
  ├── app/
  ├── bootstrap/
  ├── public/
  ├── routes/
  ├── storage/
  ├── .env.example
  └── ...
```

### **Step 3: Set Document Root**

**IMPORTANT:** Laravel's `public` folder should be the web root.

1. In hPanel, go to **Advanced** → **Domains**
2. Click **Manage** next to `gold-fox-800906.hostingersite.com`
3. Find **Document Root** setting
4. Change from: `public_html`
5. Change to: **`public_html/public`**
6. Click **Save**

### **Step 4: Set Permissions**

In File Manager:

1. Right-click on `storage` folder → **Permissions**
2. Set to: **775** (or check all boxes)
3. Apply to **all subdirectories**
4. Repeat for `bootstrap/cache` folder

### **Step 5: Create .env File**

1. In File Manager, navigate to `public_html`
2. Find `.env.example`
3. Right-click → **Copy**
4. Paste and rename to `.env`

### **Step 6: Visit the Installer**

Now visit: **https://gold-fox-800906.hostingersite.com/install**

It should work! 🎉

---

## Alternative: Quick Fix via SSH (Faster)

If you have SSH access enabled:

```bash
# Connect via SSH
ssh -p 65002 your_username@your_host

# Navigate to domain
cd domains/gold-fox-800906.hostingersite.com/

# Move files
mv public_html public_html_backup
mv public_html_backup/techcompany public_html

# Set permissions
cd public_html
chmod -R 775 storage bootstrap/cache

# Create .env
cp .env.example .env

# Clear caches
php artisan config:clear
php artisan route:clear
```

Then update Document Root in hPanel to `public_html/public`

---

## Verify It's Working

After fixing, you should be able to access:

1. **Installer:** https://gold-fox-800906.hostingersite.com/install
2. **Homepage:** https://gold-fox-800906.hostingersite.com/
3. **Admin Login:** https://gold-fox-800906.hostingersite.com/login

---

## Common Issues

### Still getting 404?

- Clear browser cache
- Check Document Root is set to `public_html/public`
- Verify .htaccess exists in `public` folder

### 500 Error?

- Check folder permissions (775 for storage and bootstrap/cache)
- Check error logs in `storage/logs/laravel.log`
- Ensure .env file exists

### Can't access hPanel?

- Make sure you're logged into the correct Hostinger account
- Domain should be: gold-fox-800906.hostingersite.com

---

## Document Root Settings Summary

| Setting           | Value                             |
| ----------------- | --------------------------------- |
| **Domain**        | gold-fox-800906.hostingersite.com |
| **Document Root** | `public_html/public`              |
| **PHP Version**   | 8.1 or higher                     |

---

## After Installation

Once /install works and you complete the wizard:

1. ✅ Database will be configured
2. ✅ Admin account will be created
3. ✅ App will be optimized
4. ✅ You can start using it!

---

## Need Help?

If you're still having issues:

1. **Check the structure:**
   - Files should be in: `public_html/` not `public_html/techcompany/`
   - Document root: `public_html/public`

2. **Verify permissions:**

   ```
   storage/ = 775
   bootstrap/cache/ = 775
   ```

3. **Check PHP version:**
   - Must be 8.1 or higher
   - Check in hPanel → Advanced → PHP Configuration

4. **Look at error logs:**
   - hPanel → Advanced → Error Logs
   - File Manager → `storage/logs/laravel.log`

---

**Let me know once you've moved the files and I'll help with the next steps!** 🚀
