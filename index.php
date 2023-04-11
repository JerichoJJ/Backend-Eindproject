<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilboard top 100</title>
    <link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="index.php">Hot100</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Info</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="README.html">ReadMe</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="https://github.com/JerichoJJ">Github</a></li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="logout.php">Log out</a>
  </li>
</ul>
<?php
    $host = "localhost";
    $dbname = "billboard_songs";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $stmt = $pdo->query("SELECT * FROM hot100");
    $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table class='table'>";
    echo "<tr>
    <th scope='col'>date</th><th scope='col'>rank</th><th scope='col'>song</th><th scope='col'>artist</th><th scope='col'>last_week</th><th scope='col'>peak_rank</th><th scope='col'>weeks_on_board</th></tr>";
    foreach ($songs as $song) {
        echo "<tr>";
        echo "<th scope='row'>" . $song['date'] . "</td>";
        echo "<td>" . $song['rank'] . "</td>";
        echo "<td>" . $song['song'] . "</td>";
        echo "<td>" . $song['artist'] . "</td>";
        echo "<td>" . $song['last_week'] . "</td>";
        echo "<td>" . $song['peak_rank'] . "</td>";
        echo "<td>" . $song['weeks_on_board'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <a href="links.php">Alle links</a>
</body>

</html>