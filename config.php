<?php
// config.php
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

// Set your admin credentials (generate the hash with: password_hash("yourpassword", PASSWORD_DEFAULT))
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD_HASH', '$2y$10$YourHashedPasswordHere'); 

// Default forwarding link for redirection
define('FORWARDING_LINK', 'index.html');
?>
