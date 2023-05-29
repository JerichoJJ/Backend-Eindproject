<?php
// Connect to the database
$dsn = "mysql:host=localhost;dbname=billboard100";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if a user ID was provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the user from the database
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found.";
        exit;
    }
} else {
    echo "User ID not specified.";
    exit;
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the new values from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Update the user in the database
    $stmt = $db->prepare("UPDATE users SET username = :username, password = :password_hash, is_admin = :is_admin WHERE id = :id");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password_hash', $password_hash);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':is_admin', $is_admin, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redirect to the list of users
    header('Location: admin.php');
    exit;
}

// Display the edit form
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="post" action="edit_user.php?id=<?php echo $id; ?>">

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>"><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>

        <label for="is_admin">Admin:</label>
        <input type="checkbox" name="is_admin" id="is_admin" <?php if ($user['is_admin']) echo 'checked'; ?>><br>

        <input type="submit" value="Save">
    </form>
</body>
</html>
