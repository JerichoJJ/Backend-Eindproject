<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $errors = [];

    if (strlen($password) < 8) {
        $errors[] = "Your password must be at least 8 characters long.";
    }
    if (!preg_match("#[0-9]+#", $password)) {
        $errors[] = "Your password must contain at least 1 number.";
    }
    if (!preg_match("#[A-Z]+#", $password)) {
        $errors[] = "Your password must contain at least 1 uppercase letter.";
    }
    if ($password !== $confirmPassword) {
        $errors[] = "Your passwords do not match.";
    }

    if (count($errors) == 0) {
        $servername = "localhost";
        $dbname = "gebruiker_data";
        $dbusername = "root";
        $dbpassword = "";

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT username FROM users WHERE username = :username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $errors[] = "Username already exists.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password_hash)");
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password_hash", $password_hash);

                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $stmt->execute();
                header("Location: login.php");
                exit();
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $stmt = null;
        $pdo = null;
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit();
    }
}
?>