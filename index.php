<?php
session_start(); // Start the session

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// The user is logged in, so display the restricted content
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilboard top 100</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<div class="body">

    <body>
        <p>index Wordt aan gewerkt</p>
        <a href="links.php">Hier vind je alle Pagina's</a>
    </body>
</div>

</html>