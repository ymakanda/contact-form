<?php
session_start();
require 'config/database.php';

$dsn = DB_DRIVER .':host='. DB_HOST. ';dbname='.DB_NAME;
$errors = [];

try {
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    if (!preg_match("/^0[1-8][0-9]{8}$/", $phone)) {
        $errors['email'] = "Please enter a valid South African phone number.";
    }

    if (count($errors) === 0) {
        $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone, message) 
            VALUES (:name, :email, :phone, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':message', $message);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Your message has been successfully submitted.";
            header("Location: list_contacts.php");
            exit();
        } else {
            $_SESSION['errors'] = $stmt->errorInfo();
            $_SESSION['formData'] = $_POST;
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $_POST;
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}


?>
