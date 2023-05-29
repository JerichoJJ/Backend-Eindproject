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
        session_start();

        $username = $_POST['username'];
        $password = $_POST['password'];

        $servername = "localhost";
        $dbname = "billboard100";
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

            if ($row['is_admin'] == 1) {
                $_SESSION['is_admin'] = true;
            } else {
                $_SESSION['is_admin'] = false;
            }

            if (!isset($_POST['username'], $_POST['password'])) {
                exit('Vul een gebruikersnaam en wachtwoord in.');
            }

            if (password_verify($password, $passwordEncrypted)) {
                echo "Gelukt, je wordt nu ingelogd.";

                // Assign the user data to the $user variable
                $user = $row;

                // Set the session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Set the user role if applicable
                if ($user['is_admin']) {
                    $_SESSION['is_admin'] = true;
                }

                // Set the login status cookie
                setcookie('login_status', 'loggedin', time() + (86400 * 30), '/'); // Expires in 30 days

                // Redirect the user to the desired page
                header("Location: index.php");
                exit();
            } else {
                echo "<div class='popup2'>
            <form method='POST' action='login.php'>
            <h2>Wachtwoorden komen niet overeen.</h2>
            <input type='submit' value='Keer terug'>
            </form>
        </div>";
            }
        } else {
            echo "<div class='popup2'>
        <form method='POST' action='login.php'>
            <h2>Gebruiker niet gevonden.</h2>
            <input type='submit' value='Keer terug'>
        </form>
    </div>";
        }

        $stmt = null;
        $pdo = null;
        ?>
    </body>
</div>

</html>