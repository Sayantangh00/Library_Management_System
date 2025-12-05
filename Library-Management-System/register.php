<?php
require 'config.php';
$error='';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if(!$name || !$email || !$password){
        $error = 'All fields are required.';
    } else {
        $conn = db_connect();
        // simple hashing using password_hash (better than plain)
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO users (name,email,password) VALUES (?,?,?)');
        $stmt->bind_param('sss',$name,$email,$hash);
        if($stmt->execute()){
            header('Location: login.php');
            exit;
        } else {
            $error = 'Could not register (email maybe taken).';
        }
        $stmt->close();
        $conn->close();
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Register</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<div class="container">
  <h2>Register</h2>
  <?php if($error) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
  <form method="post">
    <label>Name<input type="text" name="name" required></label>
    <label>Email<input type="email" name="email" required></label>
    <label>Password<input type="password" name="password" required></label>
    <button type="submit">Register</button>
  </form>
  <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body></html>
