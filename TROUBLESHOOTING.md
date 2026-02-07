# Hostinger Troubleshooting Checklist

## Current Issues

- ❌ Root URL (/) shows 403 error
- ❌ /install shows "This Page Does Not Exist"

## Root Cause

The files from GitHub haven't been pulled yet, or document root is wrong.

---

## ✅ Complete Fix (Step by Step)

### **METHOD 1: Via Hostinger hPanel (Easiest - No SSH)**

#### **Part A: Pull Code from GitHub**

1. **Login to Hostinger hPanel**
    - Go to https://hpanel.hostinger.com

2. **Access Git Version Control**
    - Click **Advanced** → **Git Version Control**

3. **Check for Existing Repository**
    - Do you see `qoritex` or any repository listed?

    **If YES:**
    - Click the **Pull** button next to it
    - Wait for it to complete
    - Skip to Part B

    **If NO:**
    - Click **Create New Repository**
    - Fill in:
        - Repository URL: `https://github.com/qoritexsolutions/qoritex.git`
        - Branch: `main`
        - Repository path: `/domains/gold-fox-800906.hostingersite.com/public_html`
    - Click **Create**
    - Wait for cloning to complete

#### **Part B: Verify File Structure**

1. **Open File Manager**
    - In hPanel, go to **Files** → **File Manager**

2. **Navigate to your domain**
    - Click: `domains` → `gold-fox-800906.hostingersite.com` → `public_html`

3. **Check the structure**

    ✅ **CORRECT (Should look like this):**

    ```
    public_html/
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── public/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── vendor/
    ├── .env.example
    ├── artisan
    ├── composer.json
    └── README.md
    ```

    ❌ **WRONG (If you see this):**

    ```
    public_html/
    └── techcompany/
        └── (Laravel files inside)
    ```

    **If WRONG:** Files are in the old structure. You need to re-pull or manually move files.

#### **Part C: Set Document Root**

1. **Go to Domains Management**
    - In hPanel: **Advanced** → **Domains**

2. **Manage Your Domain**
    - Find `gold-fox-800906.hostingersite.com`
    - Click **Manage** button

3. **Update Document Root**
    - Look for **Document Root** field
    - Current value might be: `public_html`
    - Change to: **`public_html/public`**
    - Click **Save** or **Update**

4. **Wait**
    - Changes can take 2-5 minutes to propagate
    - Clear your browser cache

#### **Part D: Set Permissions**

1. **In File Manager**
    - Navigate to `public_html`

2. **Set storage permissions**
    - Right-click `storage` folder
    - Select **Permissions**
    - Set to: **775**
    - Check "Apply to subdirectories"
    - Click **Save**

3. **Set bootstrap/cache permissions**
    - Right-click `bootstrap/cache` folder
    - Select **Permissions**
    - Set to: **775**
    - Click **Save**

#### **Part E: Check .htaccess**

1. **Navigate to public folder**
    - In File Manager: `public_html/public/`

2. **Look for .htaccess file**
    - If you DON'T see it, you need to show hidden files
    - Click the **Settings** icon → Enable **Show Hidden Files**

3. **Verify .htaccess exists**
    - File should be there
    - If missing, create it (see content below)

#### **Part F: Install Composer Dependencies (If Needed)**

If you see errors about missing classes:

1. **Access SSH** (if available)

    ```bash
    cd public_html
    composer install --no-dev
    ```

2. **OR** if no SSH, download vendor folder separately

---

### **METHOD 2: Via SSH (Faster if you have access)**

```bash
# 1. Connect
ssh -p 65002 your_username@gold-fox-800906.hostingersite.com

# 2. Navigate
cd domains/gold-fox-800906.hostingersite.com/

# 3. Check current structure
ls -la public_html/

# 4A. If repository doesn't exist, clone it
rm -rf public_html  # Only if it's empty/old
git clone https://github.com/qoritexsolutions/qoritex.git public_html

# 4B. If repository exists, pull latest
cd public_html
git pull origin main

# 5. Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# 6. Install dependencies (if needed)
composer install --no-dev --optimize-autoloader

# 7. Create .env from example
cp .env.example .env

# 8. Clear caches
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

Then set Document Root in hPanel to `public_html/public`

---

## 🧪 Test After Fix

After completing the steps above:

1. **Clear browser cache** (Ctrl+Shift+Del)
2. **Wait 2-3 minutes** for DNS/server changes
3. **Test URLs:**
    - Root: https://gold-fox-800906.hostingersite.com/
        - Should show Laravel welcome page or your homepage
    - Install: https://gold-fox-800906.hostingersite.com/install
        - Should show installation wizard

---

## 🔍 Verify Settings

### **Document Root Check:**

```
Setting: Document Root
Value should be: public_html/public
NOT: public_html
```

### **File Permissions:**

```
storage/          = 775
bootstrap/cache/  = 775
```

### **PHP Version:**

```
Must be: 8.1 or higher
Check: hPanel → Advanced → PHP Configuration
```

### **Files Present:**

```
public_html/
├── app/                 ✅
├── public/              ✅
│   ├── index.php        ✅
│   └── .htaccess        ✅
├── routes/              ✅
└── artisan              ✅
```

---

## ❓ Still Having Issues?

### **If 403 Error Persists:**

- Document root is wrong (must be `public_html/public`)
- Missing `index.php` in public folder
- Wrong PHP version (check it's 8.1+)

### **If "Page Does Not Exist":**

- Routes not loaded (run `php artisan route:clear`)
- .htaccess missing in public folder
- mod_rewrite not enabled (contact Hostinger)

### **If Files Look Wrong:**

You might need to manually delete `public_html` and re-clone:

```bash
cd domains/gold-fox-800906.hostingersite.com/
rm -rf public_html
git clone https://github.com/qoritexsolutions/qoritex.git public_html
```

---

## 📞 Quick Diagnostic Commands (SSH)

```bash
# Check file structure
ls -la public_html/

# Check PHP version
php -v

# Check if artisan is accessible
php artisan --version

# Check routes
php artisan route:list | grep install

# Check permissions
ls -la public_html/ | grep storage
```

---

## 🎯 Expected Result

After fixing everything:

✅ **https://gold-fox-800906.hostingersite.com/**

- Shows Laravel welcome page or 404 (normal if no home route)

✅ **https://gold-fox-800906.hostingersite.com/install**

- Shows Installation Wizard welcome page

✅ **Document Root**

- Set to: `public_html/public`

✅ **File Structure**

- Laravel files at root of `public_html/`
- NOT inside a `techcompany` subfolder

---

## 🚨 Most Common Issue

**90% of the time the problem is:**

**Document Root is set to `public_html` instead of `public_html/public`**

Fix this in: **hPanel → Domains → Manage → Document Root**

---

Let me know what you see after:

1. Pulling code from GitHub in hPanel
2. Setting document root to `public_html/public`
3. Waiting 2-3 minutes and refreshing
