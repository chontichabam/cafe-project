<?php
// var url
$base_url = 'http://localhost/project-cafe';

// var database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'cafe';

// connect db
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// check connection
if (!$conn) {
    die('การเชื่อมต่อล้มเหลว: ' . mysqli_connect_error());
}
?>
