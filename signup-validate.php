<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $errors = [];

    // Validate the password
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

    // If there are no validation errors, insert the user's credentials into the database
    if (count($errors) == 0) {
        $servername = "localhost";
        $dbname = "billboardtop100";
        $username = "root";
        $password = "";

        // Create a new PDO instance
        $dsn = "mysql:host=$servername;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);

        // Set PDO to throw an exception when an error occurs
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and bind the insert statement
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password_hash);

        // Hash the password before inserting it into the database
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Execute the insert statement
        try {
            $stmt->execute();
            echo "New user created successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Close the connection
        $stmt = null;
        $pdo = null;
    }
}
?>