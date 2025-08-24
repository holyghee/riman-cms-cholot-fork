# Video Upload Configuration

## Current Status ✅
Video upload functionality has been implemented for:
- **Hero Background Images/Videos** 
- **Service Images/Videos**

## File Size Limitation ⚠️
Currently limited to **2MB** for videos due to default PHP settings.
**Images and GIFs** can be up to 8MB.

## For Larger Video Files

### Option 1: Development Server mit 64MB Support (EMPFOHLEN) ✅
**Der Server läuft jetzt mit den korrekten Einstellungen!**

Falls Sie den Server neu starten müssen, verwenden Sie diesen Befehl:
```bash
cd /Users/holgerbrandt/dev/claude-code/projects/riman-cms-cholot-fork/riman-cms-unified
php -S localhost:8003 -t public -d upload_max_filesize=64M -d post_max_size=70M -d memory_limit=256M -d max_execution_time=300
```
**Videos bis 64MB funktionieren jetzt!** 🎉

### Option 2: Production Server (.htaccess)
The `.htaccess` file has been configured with:
```apache
php_value upload_max_filesize 64M
php_value post_max_size 64M
php_value max_execution_time 300
php_value max_input_time 300
php_value memory_limit 256M
```

### Option 3: System PHP.ini
Edit your system's `php.ini` file:
```ini
upload_max_filesize = 64M
post_max_size = 64M
max_execution_time = 300
max_input_time = 300
memory_limit = 256M
```

## Supported Formats
- **Images**: JPEG, PNG, WebP, JPG, GIF
- **Videos**: MP4, WebM, OGG
- **Animated**: GIF (great for small loops under 2MB)

## Technical Implementation
- Videos automatically play with `autoplay muted loop`
- Responsive design maintains aspect ratios
- Hover effects work for both images and videos
- Frontend automatically detects file type and renders appropriately

## Usage
1. Go to Admin Panel → Pages
2. Edit any page
3. Upload image or video to "Hero Background Image/Video" field
4. Add services with "Service Image/Video" fields
5. Videos will automatically display as background media