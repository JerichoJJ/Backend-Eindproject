<?php
/*The code appears to be displaying data from a MySQL database table called "hot100". It first sets up a connection to the database using PDO and displays a message indicating whether the connection was successful or not.

The code then runs a query to fetch all the data from the "hot100" table and stores it in an array called $songs. It then iterates over this array and displays the data in an HTML table format.

The code also includes a link to the "links.php" page.

The code looks well-structured and follows best practices for database connection and query execution using PDO. However, some improvements can be made to make the code more secure and maintainable:

Use prepared statements to prevent SQL injection attacks.

Do not hardcode the database credentials in the code. Store them in a separate configuration file and include it in the code.

Use error handling to handle any errors that may occur during the database connection or query execution.

Use meaningful variable names to make the code more readable.

Use CSS classes to style the HTML elements.

Overall, the code looks good, but these improvements can help make the code more secure, maintainable, and readable.*/
session_start(); // Start the session

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
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
    $host = "localhost";
    $dbname = "billboard_songs";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully to the database";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $stmt = $pdo->query("SELECT * FROM hot100");
    $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
