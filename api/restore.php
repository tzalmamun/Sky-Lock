<?php
header('Content-Type: application/json');

$pin = $_GET['pin'] ?? 'unknown';
$target_dir = "backups/";

if ($pin === 'unknown') {
    echo json_encode(["status" => "error", "message" => "Invalid PIN"]);
    exit;
}

// Find all backup files matching this PIN
$files = glob($target_dir . "backup_" . $pin . "_*.zip");
if (empty($files)) {
    echo json_encode(["status" => "error", "message" => "No backup found for this PIN"]);
    exit;
}

// Sort files to serve the latest backup
usort($files, function($a, $b) {
    return filemtime($b) - filemtime($a);
});

$latest_backup = $files[0];

if (file_exists($latest_backup)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="'.basename($latest_backup).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($latest_backup));
    readfile($latest_backup);
    exit;
} else {
    echo json_encode(["status" => "error", "message" => "File not found on server"]);
}
?>
