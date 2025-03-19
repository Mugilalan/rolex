<?php
// auth.php
session_start();
require_once 'config.php';

function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function login($username, $password) {
    if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD_HASH)) {
        session_regenerate_id(true);
        $_SESSION['logged_in'] = true;
        return true;
    }
    return false;
}

function logout() {
    session_destroy();
    header("Location: dashboard.php");
    exit();
}
?>
