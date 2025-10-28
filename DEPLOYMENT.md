# HomeKonnect Hostinger Deployment Guide

## Step-by-Step Deployment Process

### 1. Upload Files
- Upload all files to your Hostinger account
- Typical location: `/domains/homekonnectafrica.com/public_html/`

### 2. Configure .env File
```bash
# Copy .env.production to .env on the server
cp .env.production .env

# Edit .env and update:
- APP_URL=https://homekonnectafrica.com
- Check database path is correct
- Update mail settings if needed
```

### 3. Generate APP_KEY
**Option A: Via Browser**
- Visit: https://homekonnectafrica.com/generate-key.php
- Delete generate-key.php after running

**Option B: Via SSH**
```bash
php artisan key:generate
```

### 4. Setup Storage Directories
**Option A: Via Browser**
- Visit: https://homekonnectafrica.com/setup-storage.php
- Delete setup-storage.php after running

**Option B: Via SSH**
```bash
bash fix-permissions.sh
```

### 5. Set File Permissions
Via File Manager or SSH:
```bash
# Directories
find . -type d -exec chmod 755 {} \;

# Files
find . -type f -exec chmod 644 {} \;

# Storage & Cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 6. Run Artisan Commands (via SSH or Terminal in hPanel)
```bash
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

**Note:** Skip `php artisan storage:link` - we're using direct public uploads instead

### 6a. Setup File Uploads (Important!)
Since Hostinger disables `symlink()` and `exec()` functions, we use direct public uploads:

**Option A: Via Browser**
- Visit: https://homekonnectafrica.com/setup-uploads.php
- This creates the uploads directory structure
- Delete setup-uploads.php after running

**Option B: Via SSH/File Manager**
```bash
mkdir -p public/uploads/{team_members,properties,documents,kyc,profiles}
chmod -R 775 public/uploads
```

**Then update config:**
- Upload `config/filesystems-production.php` to server
- Rename it to `config/filesystems.php` (replace existing)
- Ensure .env has `FILESYSTEM_DISK=public_uploads`

### 7. Configure Document Root
In Hostinger hPanel:
- Go to: Advanced → Domains
- Click domain settings
- Set Document Root to: `public_html/public` (or your-folder/public)

### 8. Test Your Site
- Visit: https://homekonnectafrica.com
- Check: https://homekonnectafrica.com/login
- Check: https://homekonnectafrica.com/register

## Troubleshooting Common Errors

### Images Not Showing / Upload Issues
**Cause:** Hostinger disables `symlink()` and `exec()` functions

**Solution:**
1. Run setup-uploads.php to create upload directories
2. Replace config/filesystems.php with filesystems-production.php
3. Set FILESYSTEM_DISK=public_uploads in .env
4. Images will now be stored in public/uploads (accessible directly)

### 500 Internal Server Error
1. Check storage permissions (775)
2. Check .env file exists and has APP_KEY
3. Check error logs: `storage/logs/laravel.log`
4. Run: `php artisan optimize:clear`

### 403 Forbidden Error
1. Check document root points to `public` folder
2. Check .htaccess exists in public folder
3. Check index.php exists in public folder

### Database Errors
1. Ensure database/database.sqlite exists
2. Check permissions: `chmod 664 database/database.sqlite`
3. Run migrations: `php artisan migrate --force`

### CSS/JS Not Loading
1. Run: `npm run build` (locally)
2. Upload `public/build` folder
3. Check APP_URL in .env matches your domain

## File Permissions Reference
- **Folders**: 755
- **Files**: 644
- **storage/**: 775 (recursive)
- **bootstrap/cache/**: 775 (recursive)
- **.env**: 644
- **database.sqlite**: 664

## Security Checklist
- [ ] APP_DEBUG=false in production
- [ ] APP_ENV=production
- [ ] Strong APP_KEY generated
- [ ] .env file secured (644 permissions)
- [ ] Remove setup-storage.php
- [ ] Remove generate-key.php
- [ ] Remove fix-permissions.sh (or keep but secure)

## Updating the Site
1. Push changes to Git
2. Pull on server: `git pull origin main`
3. Run: `php artisan optimize:clear`
4. Run: `php artisan migrate --force` (if db changes)
5. Clear browser cache

## Support Resources
- Hostinger Support: https://support.hostinger.com
- Laravel Docs: https://laravel.com/docs
- Error Logs: `storage/logs/laravel.log`
