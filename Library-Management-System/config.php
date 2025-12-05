<?php
// Update these settings to match your local MySQL server
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', ''); // set your mysql password
define('DB_NAME', 'library_db');

function db_connect(){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($conn->connect_error) {
        die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
    }
    // set charset
    $conn->set_charset('utf8mb4');
    return $conn;
}
session_start();
?>