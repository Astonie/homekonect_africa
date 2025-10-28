# Fixing Image Upload Issue on Hostinger

## Problem
Hostinger disables the `exec()` function for security, so `php artisan storage:link` fails with:
```
Error: Call to undefined function Illuminate\Filesystem\exec()
```

## Solution Options

### Option 1: Use create-storage-link.php (Recommended - Quick Fix)

1. **Upload** `create-storage-link.php` to your server root
2. **Visit**: `https://homekonnectafrica.com/create-storage-link.php`
3. The script will create the symlink using PHP's `symlink()` function directly
4. **Delete** `create-storage-link.php` after running (security)

### Option 2: Reconfigure Storage (Permanent Solution)

If symlinks don't work or you want a more reliable solution:

1. **On the server**, replace `config/filesystems.php` with `config/filesystems-hostinger.php`:
   ```bash
   cp config/filesystems-hostinger.php config/filesystems.php
   ```

2. **Create the uploads directory**:
   ```bash
   mkdir -p public/uploads
   chmod 775 public/uploads
   ```

3. **Clear config cache**:
   ```bash
   php artisan config:clear
   php artisan optimize:clear
   ```

This changes Laravel to store public files in `public/uploads/` instead of `storage/app/public/`, eliminating the need for symlinks.

### Option 3: Manual Symlink via SSH

If you have SSH access:

```bash
cd public
ln -s ../storage/app/public storage
```

## Testing Image Uploads

After applying one of the solutions:

1. **Login** to your application as a landlord or admin
2. **Upload** a profile photo or document
3. **Check** if the image displays correctly
4. **Verify** the file exists:
   - Option 1/3: `storage/app/public/`
   - Option 2: `public/uploads/`

## Additional Notes

### For Option 2 Users
If you switch to `public/uploads/`, you need to update your `.env.production`:

```env
FILESYSTEM_DISK=public
```

And ensure your upload controllers use:
```php
Storage::disk('public')->put($path, $file);
```

### File Permissions
Make sure these directories are writable (775):
- `storage/app/public/` (Options 1 & 3)
- `public/uploads/` (Option 2)

### Moving Existing Files
If you already have files in `storage/app/public/` and want to use Option 2:

```bash
cp -r storage/app/public/* public/uploads/
```

## Which Option Should I Choose?

- ✅ **Option 1** - If you just need images working quickly and symlink() is enabled
- ✅ **Option 2** - If symlinks don't work at all on your hosting (most reliable)
- ✅ **Option 3** - If you prefer command-line and have SSH access

## Troubleshooting

### Symlink still doesn't work after Option 1
- Your hosting provider may have disabled `symlink()` function
- Use **Option 2** instead

### Images upload but don't display
- Check file permissions (775 for directories, 644 for files)
- Verify `APP_URL` in `.env` matches your domain
- Clear browser cache

### Permission denied errors
```bash
chmod -R 775 storage
chmod -R 775 public/uploads
```

---

**Last Updated**: October 28, 2025  
**Issue**: Hostinger exec() disabled preventing storage:link  
**Status**: Solutions provided above
