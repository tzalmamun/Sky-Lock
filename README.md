# SkyLock - Premium Android Calculator Vault & App Lock Solution 🛡️

**SkyLock** is a world-class, premium privacy protection and anti-theft application designed for Android devices. On the surface, it functions as a fully operational scientific calculator with real-time calculations. Beneath the decoy, it holds a secure offline vault for media, dynamic app locking, and advanced anti-uninstallation protection powered by Device Administrator privileges.

Developed by Lead Software Engineer **Al Mamun Sheikh** for **[SkyHostR Bangladesh](https://www.skyhostr.com)** — Bangladesh's #1 Software Company.

---

## 🚀 Key Features

### 1. Decoy Scientific Calculator UI
* **Real-time Calculations:** Instantly solves mathematical equations as you type.
* **Double Operator Prevention:** Automatically replaces consecutive operators (e.g., `20++` becomes `20+`).
* **Hidden Entry Vault:** Enter your unique PIN and press `=` to unlock your secret vault after a silent 1.5s transition.
* **Password Recovery:** Typing `11223344` and pressing `=` prompts a secure security question dialog for instant PIN reset.
* **Decoy Guest Mode:** Set up a Fake/Decoy PIN. Entering it opens an empty decoy vault, protecting your actual files from onlookers.

### 2. Beautiful Light-Themed Dashboard
* **iOS-Inspired UI:** Features clean, rounded material cards with elegant colored icons and smooth navigation chevrons.
* **4 Core Drawers:** Photo Vault, Video Vault, App Lock, and Intruder Gallery.

### 3. Media Vault & Auto-Gallery Deletion
* **Batch Import:** Hide multiple photos and videos at once.
* **Lag-Free Threading:** File copying runs on background threads, ensuring zero device lag even for large video files.
* **Official MediaStore Deletion:** Deletes original photos and videos permanently from the system gallery using official `MediaStore.createDeleteRequest(...)` prompts.
* **Universal Media Viewer:** Zoom in and out on hidden photos using pure Java multi-touch **Pinch-to-Zoom** gestures.
* **Batch Restore/Delete:** Long-press on thumbnails to select multiple files for bulk restoration or permanent deletion.

### 4. Advanced App Lock Service
* **30-Minute Grace Period:** Prevents annoying continuous lock prompts if the app was recently opened.
* **Anti-Looping Filters:** System settings, keyboard, and emergency dialer packages are bypass-exempt to ensure seamless typing and system accessibility.

### 5. Unbreakable Uninstall Protection
* **Device Admin Integration:** Once active, the Android OS automatically disables/grays out the "Uninstall" button.
* **Settings Lock:** To prevent bypassing, the device locks the system Settings app. Unauthorized users cannot disable Device Admin or uninstall SkyLock.

### 6. Silent Intruder Capture
* **Silent Front-Camera Capture:** Captures a high-resolution selfie using the front camera if anyone inputs a wrong PIN 3 times on the calculator or app lock screens.
* **Security Alerts:** Prompts a security alert dialog immediately upon successful login if unauthorized attempts were made.

### 7. OS-Level Security & Boot Lock
* **Instant Lock:** Trigger immediate screen lockouts via Device Policy Manager.
* **Automatic Boot Lock:** Forces a device lockout and pre-loads the lock screen overlay immediately after system boot-up, eliminating bypass attempts on reboot.
* **Hourly Auto Lock:** Restricts device access and requires the Skyhostr PIN if 1 hour has elapsed since the last lock session.

---

## ☁️ Cloud Sync & cPanel Integration Guide

SkyLock supports **Custom Cloud Domain Integration**, allowing other software agencies or buyers to connect their private cPanel web hosting and securely store encrypted backups.

### cPanel Directory Setup:
1. Log in to your cPanel File Manager and navigate to `public_html/`.
2. Create a new directory named `api/`.
3. Inside the `api/` folder, create two files: `backup.php` and `restore.php`.
4. Create an empty directory named `backups/` inside the `api/` folder.
5. In the SkyLock App settings, tap **Setup Cloud Domain** and enter your custom URL (e.g., `https://yourdomain.com`).

---

### 📥 1. File Upload Script (`backup.php`)
Paste the following code inside `public_html/api/backup.php`:

```php
<?php
header('Content-Type: application/json');

$target_dir = "backups/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
    file_put_contents($target_dir . "index.html", ""); // Prevent directory browsing
}

$pin = $_POST['pin'] ?? 'unknown';
$target_file = $target_dir . "backup_" . $pin . "_" . time() . ".zip";

if (isset($_FILES["backup_file"])) {
    if (move_uploaded_file($_FILES["backup_file"]["tmp_name"], $target_file)) {
        echo json_encode(["status" => "success", "message" => "Backup uploaded successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to save backup file."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No file uploaded"]);
}
?># Sky-Lock
