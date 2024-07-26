<?php
session_start();

define('DB_HOST', '');
define('DB_DRIVER', 'mysql');
define('DB_NAME', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');

$dsn = DB_DRIVER .':host='. DB_HOST. ';dbname='.DB_NAME;

try {
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $_SESSION['dbErrors'] = $e->getMessage();
    header("Location: index.php");
    exit();
}

