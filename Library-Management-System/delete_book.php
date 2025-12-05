<?php
require 'config.php';
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }
$id = intval($_GET['id'] ?? 0);
if($id){
    $conn = db_connect();
    $stmt = $conn->prepare('DELETE FROM books WHERE id = ?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
header('Location: dashboard.php');
exit;
?>