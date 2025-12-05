<?php
require 'config.php';
$error='';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if(!$email || !$password){
        $error = 'Both fields required.';
    } else {
        $conn = db_connect();
        $stmt = $conn->prepare('SELECT id,name,password FROM users WHERE email = ? LIMIT 1');
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows === 1){
            $stmt->bind_result($id,$name,$hash);
            $stmt->fetch();
            if(password_verify($password, $hash)){
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $name;
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Invalid credentials.';
            }
        } else {
            $error = 'Invalid credentials.';
        }
        $stmt->close();
        $conn->close();
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<div class="container">
  <h2>Login</h2>
  <?php if($error) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
  <form method="post">
    <label>Email<input type="email" name="email" required></label>
    <label>Password<input type="password" name="password" required></label>
    <button type="submit">Login</button>
  </form>
  <p>No account? <a href="register.php">Register</a></p>
</div>
</body></html>
