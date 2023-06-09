<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilboard top 100 | Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<body>
    <div class="popup">
        <form method="POST">
            <h2>Sign up</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirmPassword" placeholder="Confirm password" required>
            <input type="submit" value="Sign up">
            <p>Already have an account? <a href="login.php">Log in.</a></p>
        </form>
    </div>

    <?php include("signup-validate.php"); ?>

</body>

</html>
