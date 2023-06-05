<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilboard top 100 | Admin pagina</title>
    <link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php" style="color: #198754;">Hot100</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #198754;">Info</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="README.html">ReadMe</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="https://github.com/JerichoJJ">Github</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="admin.php" style="color: #198754;">Admin pagina</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="likepage.php" style="color: #198754;">Likes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php" style="color: #198754;">Log out</a>
        </li>
    </ul>
    <?php
    session_start();

    if (!isset($_SESSION['loggedin']) || !$_SESSION['is_admin'] == true) {
        header('Location: login.php');
        exit;
    }

    $host = "localhost";
    $dbname = "billboard100";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    ?>

    <div class="koptekst">
        <h1 class="text-center">Admin pagina</h1>
    </div>

    <div class="d-grid gap-2 col-7 mx-auto">
        <h2>Edit/Delete Users</h2>
        <?php
        // Connect to the database
        $dsn = "mysql:host=localhost;dbname=billboard100";
        $username = "root";
        $password = "";

        try {
            $db = new PDO($dsn, $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        // Retrieve users from the database
        $stmt = $db->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display a table of users
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>Is an admin</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['username'] . "</td>";
            echo "<td>" . $user['password'] . "</td>";
            echo "<td>" . ($user['is_admin'] ? 'Yes' : 'No') . "</td>";
            echo "<td><a href='edit_user.php?id=" . $user['id'] . "'>Edit</a>|<a href='delete_user.php?id=" . $user['id'] . "'>Delete</a></td>";
            echo "</tr>";
            echo "<tr></tr>";
        }
        echo "</table>";

        // Close the database connection
        $db = null;
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>