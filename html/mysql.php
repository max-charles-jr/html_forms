<?php
//$servername = "localhost";
$username = "root";
$password = "my-secret-pw";
$dbname = "my_form";

$servername = getenv('MYSQL_HOST');
//$dbname = getenv('MYSQL_DATABASE');
//$username = getenv('MYSQL_USER');
//$password = getenv('MYSQL_PASSWORD');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
