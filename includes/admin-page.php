<?php 
function wp_backup_admin_page() {
    ?>
    <div class="wrap container-fluid mt-5">
        <div class="card shadow p-4 w-100">
            <h1 class="text-primary text-center">WP Backup Plugin</h1>
            <p class="text-center">Click the button below to create a backup of your WordPress site.</p>
            <div class="text-center mt-4">
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="wp_backup_action" value="backup_now">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-database"></i> Backup Now
                    </button>
                </form>
            </div>

            <hr>
            <h4 class="text-center text-success mt-3">Upload Backup</h4>
            <form method="post" action="" enctype="multipart/form-data" class="text-center">
                <input type="file" name="backup_file" class="form-control w-50 d-inline-block">
                <button type="submit" name="upload_backup" class="btn btn-warning btn-sm mt-2">
                    <i class="fas fa-upload"></i> Upload Backup
                </button>
            </form>

            <hr>
            <h4 class="text-center text-success mt-3">Backup History</h4>
            <ul class="list-group w-100">
                <?php wp_backup_display_backup_list(); ?>
            </ul>
        </div>
    </div>
    <?php
}

// Function to display backup history
define('WP_BACKUP_DIR', WP_CONTENT_DIR . '/uploads/wp-backups/');
function wp_backup_display_backup_list() {
    if (!is_dir(WP_BACKUP_DIR)) {
        echo '<li class="list-group-item">No backups found.</li>';
        return;
    }
    
    $files = array_diff(scandir(WP_BACKUP_DIR), array('..', '.'));
    if (empty($files)) {
        echo '<li class="list-group-item">No backups found.</li>';
    } else {
        foreach ($files as $file) {
            echo '<li class="list-group-item d-flex justify-content-between align-items-center">'
                . $file .
                ' <a href="' . content_url('/uploads/wp-backups/') . $file . '" class="btn btn-sm btn-success" download>Download</a>'
                . '</li>';
        }
    }
}