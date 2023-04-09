<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilboard top 100</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
    // Database credentials
    $host = "localhost";
    $dbname = "billboard_songs";
    $username = "root";
    $password = "";

    // Create a PDO instance
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully to the database";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    // Fetch the top 100 songs from the database
    $stmt = $pdo->query("SELECT * FROM hot100");
    $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create an HTML table to display the song data
    echo "<table class='table'>";
    echo "<tr>
    <th scope='col'>date</th><th scope='col'>rank</th><th scope='col'>song</th><th scope='col'>artist</th><th scope='col'>last_week</th><th scope='col'>peek_week</th><th scope='col'>weeks_on_board</th></tr>";
    foreach ($songs as $song) {
        echo "<tr>";
        echo "<th scope='row'>" . $song['date'] . "</td>";
        echo "<td>" . $song['rank'] . "</td>";
        echo "<td>" . $song['song'] . "</td>";
        echo "<td>" . $song['artist'] . "</td>";
        echo "<td>" . $song['last_week'] . "</td>";
        echo "<td>" . $song['peek_week'] . "</td>";
        echo "<td>" . $song['weeks_on_board'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
?>

    <a href="links.php">Alle links</a>
</body>
</html>
