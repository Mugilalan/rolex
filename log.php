<?php
// log.php - Logging utility
function writeLog($message, $file = 'Log.log') {
    $date = date('Y-m-d H:i:s');
    file_put_contents($file, "[$date] $message" . PHP_EOL, FILE_APPEND);
}
?>
