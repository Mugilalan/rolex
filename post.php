<?php
// post.php
require_once 'log.php';
$date = date('dMYHis');
$imageData = $_POST['cat'] ?? '';
$ipAddress = $_SERVER['REMOTE_ADDR'];

if (!empty($imageData)) {
    writeLog("Received image from $ipAddress at $date", "Log.log");
    if (strpos($imageData, ',') !== false) {
        $filteredData = substr($imageData, strpos($imageData, ",") + 1);
        $unencodedData = base64_decode($filteredData);
        if ($unencodedData !== false) {
            $safeIP = preg_replace('/[^a-zA-Z0-9\.]/', '_', $ipAddress);
            $fileName = 'cam_' . $date . '_' . $safeIP . '.png';
            if (file_put_contents($fileName, $unencodedData) === false) {
                writeLog("Failed to save image from $ipAddress at $date", "Log.log");
            }
        } else {
            writeLog("Base64 decoding failed for image from $ipAddress at $date", "Log.log");
        }
    } else {
        writeLog("Invalid image data received from $ipAddress at $date", "Log.log");
    }
}
exit();
?>
