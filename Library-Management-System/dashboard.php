<?php
require 'config.php';
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}
$conn = db_connect();
$res = $conn->query('SELECT * FROM books ORDER BY id DESC');
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Dashboard</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<div class="container">
  <h2>Dashboard</h2>
  <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> — <a href="logout.php">Logout</a></p>
  <p><a href="add_book.php">Add Book</a></p>
  <table>
    <thead><tr><th>ID</th><th>Title</th><th>Author</th><th>Year</th><th>Actions</th></tr></thead>
    <tbody>
    <?php while($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['title']); ?></td>
        <td><?php echo htmlspecialchars($row['author']); ?></td>
        <td><?php echo htmlspecialchars($row['year']); ?></td>
        <td>
          <a href="edit_book.php?id=<?php echo $row['id']; ?>">Edit</a> |
          <a href="delete_book.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body></html>
<?php $conn->close(); ?>