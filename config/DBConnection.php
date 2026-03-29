<?php
// DBConnection.php
date_default_timezone_set('Asia/Singapore');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_csit314_final";

$conn = new mysqli($servername, $username, $password, $dbname);
 
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
