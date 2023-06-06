<?php
session_start();

if (!isset($_SESSION['loggedin']) && !isset($_COOKIE['login_status']) && $_COOKIE['login_status'] !== 'loggedin') {
  header('Location: login.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && isset($_GET['action']) && ($_GET['action'] === 'like' || $_GET['action'] === 'dislike')) {
  $songId = $_GET['id'];
  $action = $_GET['action'];

  if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
  } elseif (isset($_COOKIE['user_id'])) {
    $userId = $_COOKIE['user_id'];
  } else {
    // Redirect to login page or handle unauthorized access
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

    // Create the user_likes table if it doesn't exist
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS user_likes (
      id INT NOT NULL AUTO_INCREMENT,
      user_id INT NOT NULL,
      song_id INT NOT NULL,
      created_at DATE NOT NULL,
      type VARCHAR(255) NOT NULL,
      PRIMARY KEY (id),
      CONSTRAINT unique_user_song UNIQUE (user_id, song_id)
    )");
    $stmt->execute();

    if ($action === 'like') {
      // Check if the user has already liked or disliked the song
      $stmt = $pdo->prepare("SELECT * FROM user_likes WHERE user_id = :user_id AND song_id = :song_id");
      $stmt->bindParam(':user_id', $userId);
      $stmt->bindParam(':song_id', $songId);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['type'] === 'like') {
          // User has already liked the song, so delete the like
          $stmt = $pdo->prepare("DELETE FROM user_likes WHERE user_id = :user_id AND song_id = :song_id");
          $stmt->bindParam(':user_id', $userId);
          $stmt->bindParam(':song_id', $songId);
          $stmt->execute();
        } elseif ($row['type'] === 'dislike') {
          // User has disliked the song, so update the type to 'like'
          $stmt = $pdo->prepare("UPDATE user_likes SET type = 'like' WHERE user_id = :user_id AND song_id = :song_id");
          $stmt->bindParam(':user_id', $userId);
          $stmt->bindParam(':song_id', $songId);
          $stmt->execute();
        }
      } else {
        // User has not previously liked or disliked the song, so insert a new row with type 'like'
        $stmt = $pdo->prepare("INSERT INTO user_likes (user_id, song_id, created_at, type) VALUES (:user_id, :song_id, NOW(), 'like')");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':song_id', $songId);
        $stmt->execute();
      }
    } elseif ($action === 'dislike') {
      // Check if the user has already liked or disliked the song
      $stmt = $pdo->prepare("SELECT * FROM user_likes WHERE user_id = :user_id AND song_id = :song_id");
      $stmt->bindParam(':user_id', $userId);
      $stmt->bindParam(':song_id', $songId);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['type'] === 'like') {
          // User has liked the song, so update the type to 'dislike'
          $stmt = $pdo->prepare("UPDATE user_likes SET type = 'dislike' WHERE user_id = :user_id AND song_id = :song_id");
          $stmt->bindParam(':user_id', $userId);
          $stmt->bindParam(':song_id', $songId);
          $stmt->execute();
        } elseif ($row['type'] === 'dislike') {
          // User has already disliked the song, so delete the dislike
          $stmt = $pdo->prepare("DELETE FROM user_likes WHERE user_id = :user_id AND song_id = :song_id");
          $stmt->bindParam(':user_id', $userId);
          $stmt->bindParam(':song_id', $songId);
          $stmt->execute();
        }
      } else {
        // User has not previously liked or disliked the song, so insert a new row with type 'dislike'
        $stmt = $pdo->prepare("INSERT INTO user_likes (user_id, song_id, created_at, type) VALUES (:user_id, :song_id, NOW(), 'dislike')");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':song_id', $songId);
        $stmt->execute();
      }
    }

    // Get the updated number of likes for the song
    $stmt = $pdo->prepare("SELECT COUNT(*) AS likes_count FROM user_likes WHERE song_id = :song_id AND type = 'like'");
    $stmt->bindParam(':song_id', $songId);
    $stmt->execute();
    $likesCount = $stmt->fetch(PDO::FETCH_ASSOC)['likes_count'];

    // Get the updated number of dislikes for the song
    $stmt = $pdo->prepare("SELECT COUNT(*) AS dislikes_count FROM user_likes WHERE song_id = :song_id AND type = 'dislike'");
    $stmt->bindParam(':song_id', $songId);
    $stmt->execute();
    $dislikesCount = $stmt->fetch(PDO::FETCH_ASSOC)['dislikes_count'];

    // Calculate the total likes count by subtracting dislikes from likes
    $totalLikesCount = $likesCount - $dislikesCount;

    // Echo the total likes count for the song
    echo "<script>document.getElementById('likes_$songId').textContent = $likesCount;</script>";
    echo "<script>document.getElementById('dislikes_$songId').textContent = $dislikesCount;</script>";

    // Redirect back to the index.php page
    header('Location: index.php');
    exit;
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
} else {
  header('Location: index.php');
  exit;
}
