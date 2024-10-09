<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Mumtaz12@#'); // Replace with your actual MySQL root password
define('DB_NAME', 'crud_project');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>