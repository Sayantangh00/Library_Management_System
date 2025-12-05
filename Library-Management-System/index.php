<?php
require 'config.php';
if(isset($_SESSION['user_id'])){
    header('Location: dashboard.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome - Library</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Welcome to the Sample Library App</h1>
    <p><a href="register.php">Register</a> or <a href="login.php">Login</a></p>
  </div>
</body>
</html>
