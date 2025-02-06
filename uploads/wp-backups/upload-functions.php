<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

if (isset($_POST['upload_backup'])) {
    wp_backup_upload_file();
}

function wp_backup_upload_file() {
    if (!isset($_FILES['backup_file']) || $_FILES['backup_file']['error'] != UPLOAD_ERR_OK) {
        echo '<div class="alert alert-danger mt-3 text-center">Error uploading file!</div>';
        return;
    }

    $file_name = basename($_FILES['backup_file']['name']);
    $target_file = WP_BACKUP_DIR . $file_name;

    // Ensure it's a .zip file
    if (pathinfo($file_name, PATHINFO_EXTENSION) !== 'zip') {
        echo '<div class="alert alert-danger mt-3 text-center">Only ZIP files are allowed!</div>';
        return;
    }

    if (move_uploaded_file($_FILES['backup_file']['tmp_name'], $target_file)) {
        echo '<div class="alert alert-success mt-3 text-center">Backup uploaded successfully!</div>';
    } else {
        echo '<div class="alert alert-danger mt-3 text-center">Failed to upload backup!</div>';
    }
}
