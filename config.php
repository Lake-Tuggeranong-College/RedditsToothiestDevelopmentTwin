<?php
session_start();
$servername = "10.177.200.71";
$username = "r2d2";
$password = "r2d2";
$dbname = "r2d2";
$errorCaught = false;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $errorCaught = true;
    $_SESSION['flash_message'] = "<div class='bg-danger'>The Database cannot be found: " . $servername . ". Error:".$e."</div>";
}
if (!$errorCaught) {
    //echo "Database connection configured correctly, and database connection good.";
}

//$conn = null;
?>
