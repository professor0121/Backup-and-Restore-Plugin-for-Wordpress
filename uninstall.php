 
<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

$backup_dir = WP_CONTENT_DIR . '/uploads/wp-backups/';
if (is_dir($backup_dir)) {
    array_map('unlink', glob("$backup_dir*.*"));
    rmdir($backup_dir);
}
