<?php
// Secured & Powered by www.skyhostr.com
header('Content-Type: application/json');

$target_dir = "backups/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
    file_put_contents($target_dir . "index.html", ""); // ব্রাউজিং প্রটেক্ট
}

$pin = $_POST['pin'] ?? 'unknown';
$target_file = $target_dir . "backup_" . $pin . "_" . time() . ".zip";

if (isset($_FILES["backup_file"])) {
    if (move_uploaded_file($_FILES["backup_file"]["tmp_name"], $target_file)) {
        echo json_encode(["status" => "success", "message" => "Backup uploaded to server successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to save backup file on server."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No file received."]);
}
?>
