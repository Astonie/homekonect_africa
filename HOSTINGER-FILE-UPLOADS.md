# Hostinger File Upload Fix - Complete Guide

## Problem
Hostinger shared hosting disables:
- `symlink()` function
- `exec()` function

This prevents Laravel's standard `php artisan storage:link` from working.

## Solution
Store uploaded files directly in `public/uploads` instead of `storage/app/public`

---

## Step-by-Step Fix (Choose One Method)

### Method 1: Automated Setup (Recommended)

1. **Upload setup-uploads.php to your server root**

2. **Visit the script in your browser:**
   ```
   https://homekonnectafrica.com/setup-uploads.php
   ```

3. **You should see:**
   ```
   ✅ Created: public/uploads
   ✅ Created: public/uploads/team_members
   ✅ Created: public/uploads/properties
   ✅ Created: public/uploads/documents
   ✅ Created: public/uploads/kyc
   ✅ Created: public/uploads/profiles
   ```

4. **Update filesystem configuration:**
   - Upload `config/filesystems-production.php` to your server
   - Rename it to `config/filesystems.php` (replace the existing one)
   - Or manually edit `config/filesystems.php` on server

5. **Update .env file on server:**
   ```bash
   FILESYSTEM_DISK=public_uploads
   ```

6. **Delete setup-uploads.php for security**

7. **Clear cache:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

---

### Method 2: Manual Setup (If you have SSH/File Manager access)

1. **Create directories via SSH:**
   ```bash
   cd public_html  # or wherever your Laravel app is
   mkdir -p public/uploads/{team_members,properties,documents,kyc,profiles}
   chmod -R 775 public/uploads
   ```

2. **Or use Hostinger File Manager:**
   - Navigate to `public_html/public`
   - Create folder: `uploads`
   - Inside `uploads`, create:
     - `team_members`
     - `properties`
     - `documents`
     - `kyc`
     - `profiles`
   - Set all permissions to 775

3. **Replace config/filesystems.php:**
   ```php
   'default' => env('FILESYSTEM_DISK', 'public_uploads'),

   'disks' => [
       'public_uploads' => [
           'driver' => 'local',
           'root' => public_path('uploads'),
           'url' => env('APP_URL').'/uploads',
           'visibility' => 'public',
           'throw' => false,
       ],
       // ... other disks
   ],
   ```

4. **Update .env:**
   ```bash
   FILESYSTEM_DISK=public_uploads
   ```

5. **Clear cache:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

---

## Verification

### Test File Upload:
1. Log into your admin dashboard
2. Go to Team Members → Add New
3. Upload a photo
4. The image should now display correctly

### Check File Location:
- Files should be stored in: `public_html/public/uploads/team_members/`
- Accessible at: `https://homekonnectafrica.com/uploads/team_members/filename.jpg`

---

## How It Works

### Before (Standard Laravel - Doesn't Work on Hostinger):
```
Upload → storage/app/public/file.jpg
         ↓ (symlink - BLOCKED)
Access → public/storage/file.jpg
```

### After (Our Solution - Works on Hostinger):
```
Upload → public/uploads/file.jpg
         ↓ (direct access - NO SYMLINK NEEDED)
Access → public/uploads/file.jpg
```

---

## Important Notes

1. **No Code Changes Needed**: Your controllers already use `Storage::disk('public')->put()`. By changing the default disk to `public_uploads`, everything works automatically.

2. **Migration from Local**: If you already have uploads in `storage/app/public` locally:
   - Copy them to `public/uploads` before deploying
   - Or manually move them on the server

3. **Security**: The `uploads` folder is in `public`, which is fine for user-uploaded images/documents since they need to be publicly accessible anyway.

4. **Backup**: Always backup your `public/uploads` folder before major updates.

---

## Troubleshooting

### Images still not showing?
1. Check `.env` has `FILESYSTEM_DISK=public_uploads`
2. Run `php artisan config:clear`
3. Check folder permissions: `chmod -R 775 public/uploads`
4. Check APP_URL in .env matches your domain

### Permission denied errors?
```bash
chmod -R 775 public/uploads
chown -R u994525900:u994525900 public/uploads  # Replace with your Hostinger username
```

### Want to keep old storage/app/public files?
You can keep both disks:
```php
// In config/filesystems.php
'disks' => [
    'public_uploads' => [...],  // New default
    'public' => [...],          // Keep for old files
],
```

---

## Summary

✅ **What we fixed:**
- Removed dependency on `symlink()` function
- Files now stored in `public/uploads` (directly accessible)
- No need for `php artisan storage:link`

✅ **What stays the same:**
- Your controller code (no changes needed)
- File upload logic
- Storage facade usage

✅ **Benefits:**
- Works on all shared hosting providers
- Simpler deployment
- No symlink issues
- Direct file access (faster)

---

**Questions?** Check the main DEPLOYMENT.md file or contact support.
