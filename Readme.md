# WP Backup Plugin

## Description
The WP Backup Plugin is a simple and efficient solution for backing up your WordPress site, including the database and all files. Ensure your data is safe and recoverable with our easy-to-use backup tool.

## Features
- One-click backup creation
- Automatic daily backups
- Backup file upload and restore
- Backup history management
- Easy-to-use admin interface

## Installation
1. Download the plugin zip file from the [plugin repository](https://yourwebsite.com).
2. Go to your WordPress admin dashboard.
3. Navigate to **Plugins > Add New**.
4. Click on **Upload Plugin** and choose the downloaded zip file.
5. Click **Install Now** and then activate the plugin.

## Usage
1. Navigate to the **WP Backup** settings page in your WordPress admin dashboard.
2. To create a backup, click on the **Backup Now** button.
3. To upload a backup, use the **Upload Backup** section.
4. View and download previous backups from the **Backup History** section.

## Functions and Their Working

### `wp_backup_enqueue_assets()`
This function enqueues the necessary CSS and JavaScript files for the plugin's admin interface, including Bootstrap and Font Awesome.

### `wp_backup_activate()`
This function sets up a daily cron job to automate backups when the plugin is activated.

### `wp_backup_deactivate()`
This function clears the scheduled cron job when the plugin is deactivated.

### `wp_backup_admin_menu()`
This function adds a new menu item to the WordPress admin dashboard for the WP Backup Plugin.

### `wp_backup_admin_page()`
This function renders the admin page for the plugin, including the backup creation form, upload form, and backup history.

### `wp_backup_upload_file()`
This function handles the upload of backup files, ensuring they are valid ZIP files and moving them to the backup directory.

### `wp_backup_create_backup()`
This function creates a ZIP archive of the entire WordPress site, excluding the backup directory itself, and saves it in the backup directory.

### `wp_backup_display_backup_list()`
This function displays a list of existing backups in the backup directory, allowing users to download them.

## Screenshots
1. **Backup Page** - The main interface for creating and managing backups.
   ![Backup Page](https://yourwebsite.com/screenshots/backup-page.png)
2. **Backup History** - View and download previous backups.
   ![Backup History](https://yourwebsite.com/screenshots/backup-history.png)

## Frequently Asked Questions

### How do I restore a backup?
To restore a backup, upload the backup file using the **Upload Backup** section. The plugin will handle the rest.

### Where are the backups stored?
Backups are stored in the `wp-content/uploads/wp-backups/` directory of your WordPress installation.

## Changelog
### 1.0.0
- Initial release

## Support
For support, please visit our [support forum](https://yourwebsite.com/support) or contact us at [support@yourwebsite.com](mailto:support@yourwebsite.com).

## License
This plugin is licensed under the GPL2 license. See the [LICENSE](https://yourwebsite.com/license) file for more information.
