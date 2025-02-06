 
<?php
/*
Plugin Name: WP Backup Plugin
Plugin URI: https://yourwebsite.com
Description: A simple WordPress backup plugin for files and database.
Version: 1.0
Author: Professor
Author URI: https://yourwebsite.com
License: GPL2
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin path
define('WP_BACKUP_PLUGIN_DIR', plugin_dir_path(__FILE__));

//enqueue the style
function wp_backup_enqueue_assets() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');
}
add_action('admin_enqueue_scripts', 'wp_backup_enqueue_assets');


// Include required files
require_once WP_BACKUP_PLUGIN_DIR . 'includes/admin-page.php';
require_once WP_BACKUP_PLUGIN_DIR . 'uploads/wp-backups/upload-functions.php';
require_once WP_BACKUP_PLUGIN_DIR . 'includes/backup-functions.php';

// Activation Hook
define('WP_BACKUP_PLUGIN_VERSION', '1.0');
function wp_backup_activate() {
    if (!wp_next_scheduled('wp_backup_cron_job')) {
        wp_schedule_event(time(), 'daily', 'wp_backup_cron_job');
    }
}
register_activation_hook(__FILE__, 'wp_backup_activate');

// Deactivation Hook
function wp_backup_deactivate() {
    wp_clear_scheduled_hook('wp_backup_cron_job');
}
register_deactivation_hook(__FILE__, 'wp_backup_deactivate');

// Admin Menu
function wp_backup_admin_menu() {
    add_menu_page(
        'WP Backup',
        'WP Backup',
        'manage_options',
        'wp-backup',
        'wp_backup_admin_page',
        'dashicons-backup',
        99
    );
}
add_action('admin_menu', 'wp_backup_admin_menu');