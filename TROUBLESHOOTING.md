# ProGear Hub - Troubleshooting Guide

## HTTP ERROR 405 - Method Not Allowed

### What causes this error?
The HTTP 405 error occurs when you try to access `php/contact_process.php` or `php/order_process.php` directly in your browser. These files are designed to only accept POST requests from HTML forms, not GET requests from direct browser access.

### How to fix it:

1. **✅ CORRECT WAY**: Access the forms through HTML pages
   - Go to `http://localhost/progear-hub/contact.html` for the contact form
   - Go to `http://localhost/progear-hub/orders.html` for the order form

2. **❌ INCORRECT WAY**: Don't access PHP files directly
   - Don't go to `http://localhost/progear-hub/php/contact_process.php`
   - Don't go to `http://localhost/progear-hub/php/order_process.php`

### Step-by-step testing:

1. **Start XAMPP**:
   - Open XAMPP Control Panel
   - Start Apache and MySQL services

2. **Test database connection**:
   - Go to `http://localhost/progear-hub/test_db.php`
   - This will verify your database is working

3. **Test the contact form**:
   - Go to `http://localhost/progear-hub/contact.html`
   - Fill out the form and submit
   - You should be redirected back with a success message

4. **Test the order form**:
   - Go to `http://localhost/progear-hub/orders.html`
   - Fill out the form and submit
   - You should be redirected back with a success message

## Database Setup

If you haven't set up the database yet:

1. **Open phpMyAdmin**: `http://localhost/phpmyadmin`

2. **Create the database**:
   - Click "New" to create a new database
   - Name it `ProGearHub`
   - Select `utf8mb4_unicode_ci` as the collation

3. **Import the schema**:
   - Select the `ProGearHub` database
   - Go to "Import" tab
   - Choose the file `db/progearhub_schema_seed.sql`
   - Click "Go" to import

## Common Issues

### 1. XAMPP not running
- Make sure Apache and MySQL are started in XAMPP Control Panel
- Check that ports 80 and 3306 are not being used by other applications

### 2. Database connection failed
- Verify MySQL is running in XAMPP
- Check the database credentials in `php/config.php`
- Make sure the `ProGearHub` database exists

### 3. Forms not submitting
- Check that the form action paths are correct (relative paths)
- Verify that all required fields are filled out
- Check browser console for JavaScript errors

### 4. File permissions
- Make sure PHP files are readable by the web server
- On Windows with XAMPP, this is usually not an issue

## File Structure

```
progear-hub/
├── index.html          # Home page
├── contact.html        # Contact form page
├── orders.html         # Order form page
├── php/
│   ├── config.php      # Database configuration
│   ├── contact_process.php  # Processes contact form
│   └── order_process.php    # Processes order form
├── db/
│   └── progearhub_schema_seed.sql  # Database schema
└── test_db.php         # Database connection test
```

## Testing Checklist

- [ ] XAMPP Apache and MySQL are running
- [ ] Database `ProGearHub` exists and has tables
- [ ] `test_db.php` shows successful connection
- [ ] Contact form submits successfully
- [ ] Order form submits successfully
- [ ] No JavaScript errors in browser console

## Support

If you're still having issues:
1. Check the browser's developer console for errors
2. Check XAMPP's error logs
3. Verify all file paths are correct
4. Test with the `test_db.php` file first
