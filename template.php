<?php
// template.php
require_once 'config.php';
require_once 'log.php';
include 'ip.php';

$logFile = 'redirects.log';
$date = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
writeLog("Redirected IP: $ip", $logFile);

// Use the forwarding link from configuration; if index2.html doesn't exist, default to index.html
$forwarding_link = FORWARDING_LINK;
if (!file_exists('index2.html')) {
    $forwarding_link = 'index.html';
}
header('Location: ' . $forwarding_link);
exit;
?>
