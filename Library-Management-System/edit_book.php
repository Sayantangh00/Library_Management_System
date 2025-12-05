<?php
require 'config.php';
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }
$id = intval($_GET['id'] ?? 0);
if(!$id){ header('Location: dashboard.php'); exit; }
$conn = db_connect();
$stmt = $conn->prepare('SELECT id,title,author,year FROM books WHERE id=? LIMIT 1');
$stmt->bind_param('i',$id);
$stmt->execute();
$res = $stmt->get_result();
$book = $res->fetch_assoc();
if(!$book){ header('Location: dashboard.php'); exit; }
$error='';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $year = intval($_POST['year'] ?? 0) ?: null;
    if(!$title) { $error='Title required.'; }
    else {
        $u = $conn->prepare('UPDATE books SET title=?,author=?,year=? WHERE id=?');
        $u->bind_param('ssii',$title,$author,$year,$id);
        if($u->execute()){
            header('Location: dashboard.php');
            exit;
        } else { $error='Could not update.'; }
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Book</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body><div class="container">
  <h2>Edit Book</h2>
  <?php if($error) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
  <form method="post">
    <label>Title<input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required></label>
    <label>Author<input type="text" name="author" value="<?php echo htmlspecialchars($book['author']); ?>"></label>
    <label>Year<input type="number" name="year" value="<?php echo htmlspecialchars($book['year']); ?>"></label>
    <button type="submit">Update</button>
  </form>
  <p><a href="dashboard.php">Back</a></p>
</div></body></html>
<?php $stmt->close(); $conn->close(); ?>