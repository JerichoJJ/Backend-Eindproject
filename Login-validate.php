<?php

$username = $_POST['username2'];
$password = $_POST['password2'];

$servername = "localhost";
$dbname = "gebruiker_data";
$username_db = "root";
$password_db = "";

$dsn = "mysql:host=$servername;dbname=$dbname";
$pdo = new PDO($dsn, $username_db, $password_db);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindParam(":username", $username);

$stmt->execute();

if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $passwordEncrypted = $row['password'];
    $errors = [];

    if (password_verify($password, $passwordEncrypted)) {
        echo "Gelukt, je wordt nu ingelogd.";
        header("Location: index.php");
        exit();
    } else {
        echo "Wachtwoorden komen niet overeen.";
    }
} else {
    echo "Gebruiker niet gevonden.";
}


$stmt = null;
$pdo = null;
