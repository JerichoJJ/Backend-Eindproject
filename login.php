<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilboard top 100 | Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<div class="body">

    <body>
        <div class="popup">

            <form method="POST" action="login-validate.php">
            <h2>Login</h2>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="submit" value="Log in">
                <p>Heb je geen account? <a href="signup.php">Maak een account aan.</a></p>
            </form>

        </div>
    </body>
</div>

</html>