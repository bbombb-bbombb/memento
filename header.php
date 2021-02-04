<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$username = "roott";
$password = "root";
$dbname = "memento";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>