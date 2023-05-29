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
      $stmt = $pdo->prepare("INSERT INTO user_likes (song_id, user_id) VALUES (:song_id, :user_id)");
      $stmt->bindParam(':song_id', $songId);
      $stmt->bindParam(':user_id', $userId);
      $stmt->execute();
    } elseif ($action === 'dislike') {
      // Delete the corresponding row from the user_likes table
      $stmt = $pdo->prepare("DELETE FROM user_likes WHERE song_id = :song_id AND user_id = :user_id");
      $stmt->bindParam(':song_id', $songId);
      $stmt->bindParam(':user_id', $userId);
      $stmt->execute();
    }

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
