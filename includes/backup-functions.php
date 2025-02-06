<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

// define('WP_BACKUP_DIR', WP_CONTENT_DIR . '/uploads/wp-backups/');

function wp_backup_create_backup() {
    if (!is_dir(WP_BACKUP_DIR)) {
        mkdir(WP_BACKUP_DIR, 0755, true);
    }

    $backup_file = WP_BACKUP_DIR . 'backup-' . date('Y-m-d-H-i-s') . '.zip';
    $zip = new ZipArchive();

    if ($zip->open($backup_file, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        $root_path = realpath(ABSPATH);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($root_path, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            if (!$file->isDir()) {
                $file_path = $file->getRealPath();
                $relative_path = str_replace($root_path . DIRECTORY_SEPARATOR, '', $file_path);
                
                // Prevent including the backup folder itself
                if (strpos($file_path, WP_BACKUP_DIR) === false) {
                    $zip->addFile($file_path, $relative_path);
                }
            }
        }

        $zip->close();
        return $backup_file;
    } else {
        return false;
    }
}

// Handle backup request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wp_backup_action']) && $_POST['wp_backup_action'] === 'backup_now') {
    $backup_path = wp_backup_create_backup();
    if ($backup_path) {
        echo '<div class="alert alert-success mt-3 text-center">
                Backup Created Successfully! 
                <a href="' . content_url('/uploads/wp-backups/') . basename($backup_path) . '" class="btn btn-sm btn-success" download>Download Now</a>
              </div>';
    } else {
        echo '<div class="alert alert-danger mt-3 text-center">Backup Failed!</div>';
    }
}
