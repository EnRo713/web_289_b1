<?php
$host = "localhost"; // SiteGround
$dbname = "dbtveeql6tcmni";
$username = "uxoizzgxokrha";
$password = "1l1q%);g%@)1";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
