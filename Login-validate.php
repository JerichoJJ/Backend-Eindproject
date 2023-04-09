<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilboard top 100</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<div class="keer terug">

    <body>
        <?php

        $username = $_POST['username'];
        $password = $_POST['password'];

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
                echo "<div class= 'popup2'>
                <form method='POST' action='login.php'>
                <h2>Wachtwoorden komen niet overeen.</h2>
                    <input type='submit' value='Keer terug'>
                </form></div>";
            }
        } else {
            echo "<div class= 'popup2'>
            <form method='POST' action='login.php'>
    <h2>Gebruiker niet gevonden.</h2>
        <input type='submit' value='Keer terug'>
    </form></div>";
        }


        $stmt = null;
        $pdo = null;
        ?>
    </body>
</div>

</html>