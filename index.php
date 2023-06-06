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
      <a class="nav-link active" aria-current="page" href="index.php" style="color: #198754;">Hot100</a>
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
      <a class="nav-link" href="admin.php" style="color: #198754;">Admin pagina</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php" style="color: #198754;">Log out</a>
    </li>
  </ul>
  <?php
  $host = "localhost";
  $dbname = "billboard100";
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

  echo "<table class='table table-success table-striped table-hover'>";
  echo "<tr>
    <th scope='col'>Bilboard nummer</th><th scope='col'>Titel</th><th scope='col'>Artiest(en)</th><th scope='col'>Likes</th><th scope='col'>Dislikes</th><th scope='col'>Aantal likes</th><th scope='col'>Aantal dislikes</th><th scope='col'>Positie vorige week</th><th scope='col'>Hoogste positie</th><th scope='col'>Aantal weken in de lijst</th>
  </tr>";
  foreach ($songs as $song) {
    $songId = $song['id'];

    // Retrieve the number of likes for the current song
    $stmt = $pdo->prepare("SELECT COUNT(*) as likes_count FROM user_likes WHERE song_id = :song_id AND type = 'like'");
    $stmt->bindParam(':song_id', $songId);
    $stmt->execute();
    $likesCount = $stmt->fetch(PDO::FETCH_ASSOC)['likes_count'];

    // Retrieve the number of dislikes for the current song
    $stmt = $pdo->prepare("SELECT COUNT(*) as dislikes_count FROM user_likes WHERE song_id = :song_id AND type = 'dislike'");
    $stmt->bindParam(':song_id', $songId);
    $stmt->execute();
    $dislikesCount = $stmt->fetch(PDO::FETCH_ASSOC)['dislikes_count'];

    echo "<tr>
      <td>{$song['rank']}</td>
      <td>{$song['song']}</td>
      <td>{$song['artist']}</td>
      <td><span id='likes_$songId'>$likesCount</span></td>
      <td><span id='dislikes_$songId'>$dislikesCount</span></td>
      <td><a href='like_song.php?id=$songId&action=like'>👍</a></td>
      <td><a href='like_song.php?id=$songId&action=dislike'>👎</a></td>
      <td>{$song['last_week']}</td>
      <td>{$song['peak_rank']}</td>
      <td>{$song['weeks_on_board']}</td>
    </tr>";
  }
  echo "</table>";
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
