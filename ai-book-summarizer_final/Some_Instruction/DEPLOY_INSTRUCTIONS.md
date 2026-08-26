# InfinityFree Deployment Instructions

## Step 1: Upload Files
1. Go to infinityfree.net and login
2. Go to File Manager
3. Upload the entire `dist` folder (or drag and drop)
4. Make sure to upload ALL files including:
   - index.html
   - assets/ folder (with all CSS and JS files)
   - All images (.jpg, .png files)

**Alternative: Upload to htdocs**
1. In File Manager, navigate to the root directory
2. Look for or create the `htdocs` folder
3. Upload the entire `dist` folder contents to `htdocs`
4. Ensure index.html is at the root of htdocs
5. Upload all assets and images to htdocs/assets/

## Step 2: Configure Settings

### Method 1: Right-Click Approach
1. In File Manager, find index.html
2. Right-click → "Set as Homepage" (if available)
3. Go to Domain Settings → Point your domain to the uploaded files

### Method 2: Domain Settings Approach
1. Go to Domain Settings in your hosting panel
2. Look for these specific options:
   - "Document Root" 
   - "Web Root"
   - "Website Root"
   - "Public Directory"
   - "Web Directory"
   - "Site Root"
3. Set it to: `/` (root directory) or `/htdocs` 
4. Save settings

**Where to look in InfinityFree Control Panel:**
- Left sidebar → "Domains" → "Manage Domains"
- Or "Website Settings" → "Domain Configuration"
- Or "File Manager" → "Settings" tab
- Look for any field that asks for folder path

### Method 3: File Manager Approach
1. In File Manager, look for "Settings" or "Preferences"
2. Find "Default Document" or "Index File" setting
3. Set it to: `index.html`
4. Ensure index.html is in the root directory

### Method 4: .htaccess Approach (RECOMMENDED - Works Always)
1. Create `.htaccess` file in your root directory (htdocs/)
2. Add these lines:
   ```
   DirectoryIndex index.html
   Options +Indexes
   ```
3. Upload the .htaccess file to htdocs/ directory
4. This forces index.html to be the default page
5. Works on virtually all hosting providers

**How to create .htaccess:**
- Open Notepad or any text editor
- Type the lines above
- Save as: `.htaccess` (with the dot at beginning)
- Make sure file type is "All Files" when saving

## Step 3: Test Your App
1. Visit your domain: http://your-domain.infinityfree.net
2. Test all features:
   - Login/Signup functionality
   - Text summarization
   - Bullet point formatting
   - PDF upload
   - All API integrations

## Important Notes
- InfinityFree supports static HTML/CSS/JS files perfectly
- No server configuration needed
- Your React app will work as-is
- API keys are stored securely in frontend
- All features should work immediately

## Troubleshooting

### White Screen or 404 Errors:
1. **Asset Path Issue Fixed**: Updated Vite config with `base: './'`
2. **Rebuild Required**: Run `npm run build` again (already done)
3. **Reupload Files**: Upload the NEW dist folder contents
4. **Clear browser cache** and refresh

### Specific Error Fix:
If you see:
```
GET https://errors.infinityfree.net/errors/404/
Refused to apply style from 'https://errors.infinityfree.net/errors/404/'
```

**Solution:**
1. Delete old files from htdocs
2. Upload the NEW dist folder (rebuilt with correct paths)
3. Keep the .htaccess file
4. Test again

### General Troubleshooting:
1. Check that ALL files were uploaded
2. Verify index.html is in root directory
3. Ensure assets folder is uploaded correctly
4. Check browser console for errors
