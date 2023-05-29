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

    if ($action === 'like') {
      // Insert a new row into the user_likes table
      $stmt = $pdo->prepare("INSERT INTO user_likes (user_id, song_id, created_at) VALUES (:user_id, :song_id, NOW())");
      $stmt->bindParam(':user_id', $userId);
      $stmt->bindParam(':song_id', $songId);
      $stmt->execute();
    } elseif ($action === 'dislike') {
      // Check if the user has already liked or disliked the song
      $stmt = $pdo->prepare("SELECT * FROM user_likes WHERE user_id = :user_id AND song_id = :song_id");
      $stmt->bindParam(':user_id', $userId);
      $stmt->bindParam(':song_id', $songId);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        // User has already liked or disliked the song, so delete the corresponding row from the user_likes table
        $stmt = $pdo->prepare("DELETE FROM user_likes WHERE user_id = :user_id AND song_id = :song_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':song_id', $songId);
        $stmt->execute();
      }
    }

    // Get the updated number of likes for the song
    $stmt = $pdo->prepare("SELECT COUNT(*) as likes_count FROM user_likes WHERE song_id = :song_id");
    $stmt->bindParam(':song_id', $songId);
    $stmt->execute();
    $likesCount = $stmt->fetch(PDO::FETCH_ASSOC)['likes_count'];

    // Echo the likes count for the song
    echo "<script>document.getElementById('likes_$songId').textContent = '$likesCount';</script>";

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
?>
