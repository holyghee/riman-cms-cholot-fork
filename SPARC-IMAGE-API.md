# SPARC: Image Management API for Cholot CMS

## Situation
The CMS has issues with image display and management:
- Images not showing on frontend (403 Forbidden errors)
- Backend FileUpload fields expecting IDs instead of paths
- No proper image upload/storage workflow
- Laravel's built-in serve command has file serving limitations
- Need API for programmatic image management

## Problem
1. Images stored in multiple locations without proper access
2. Filament admin panel can't handle direct image paths
3. No storage symlink or proper public access setup
4. Database stores paths but Filament expects media IDs
5. Need API endpoints for external image management

## Approach
1. **Fix Storage Configuration**
   - Create proper storage symlink
   - Configure public disk correctly
   - Set proper permissions

2. **Create Media Model & Migration**
   - Track uploaded images in database
   - Store metadata (path, size, mime type)
   - Generate unique IDs for Filament

3. **Build Image Management API**
   - Upload endpoint
   - List/search endpoint
   - Delete endpoint
   - Bulk operations

4. **Update Filament Integration**
   - Use Media model relationships
   - Custom FileUpload field handling
   - Preview functionality

5. **Frontend Display Fix**
   - Use Storage facade properly
   - Generate public URLs
   - Handle fallbacks

## Result
- Working image uploads through backend
- Proper image display on frontend
- API for external image management
- Consistent storage strategy

## Check
- [ ] Images accessible via public URLs
- [ ] Backend upload functionality works
- [ ] API endpoints tested and documented
- [ ] All existing images migrated
- [ ] Frontend displays images correctly