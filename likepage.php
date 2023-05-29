<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilboard top 100 | Likes pagina</title>
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
    <div class="d-grid gap-2 col-3 mx-auto">
        <?php
        session_start();

        if (!isset($_SESSION['loggedin']) || !$_SESSION['is_admin'] == true) {
            header('Location: login.php');
            exit;
        }

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "billboard100";

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Retrieve all user likes from the user_likes table
            $stmt = $pdo->query("SELECT * FROM user_likes");
            $userLikes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if there are any user likes
            if (count($userLikes) > 0) {
                echo "<table>";
                echo "<tr><th>User ID</th><th>Song ID</th><th>Created At</th></tr>";
                foreach ($userLikes as $userLike) {
                    echo "<tr>";
                    echo "<td>" . $userLike['user_id'] . "</td>";
                    echo "<td>" . $userLike['song_id'] . "</td>";
                    echo "<td>" . $userLike['created_at'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No user likes found.";
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>

    </div>
</body>

</html>