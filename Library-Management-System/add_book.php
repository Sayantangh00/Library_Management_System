<?php
require 'config.php';
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $year = intval($_POST['year'] ?? 0) ?: null;
    if(!$title){ $error='Title required.'; }
    else {
        $conn = db_connect();
        $stmt = $conn->prepare('INSERT INTO books (title,author,year) VALUES (?,?,?)');
        $stmt->bind_param('ssi',$title,$author,$year);
        if($stmt->execute()){
            header('Location: dashboard.php');
            exit;
        } else { $error='Could not add book.'; }
        $stmt->close();
        $conn->close();
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Add Book</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body><div class="container">
  <h2>Add Book</h2>
  <?php if($error) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
  <form method="post">
    <label>Title<input type="text" name="title" required></label>
    <label>Author<input type="text" name="author"></label>
    <label>Year<input type="number" name="year"></label>
    <button type="submit">Save</button>
  </form>
  <p><a href="dashboard.php">Back to dashboard</a></p>
</div></body></html>
