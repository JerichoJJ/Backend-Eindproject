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

    if (count($errors) > 0) {
        echo '<div class="errors"><ul>';
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    } else {
        header("Location: index.php");
        exit();
    }
}
?>
