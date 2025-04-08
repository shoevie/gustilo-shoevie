<?php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT id, password_hash FROM users WHERE username = ?');
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $passwordHash);
            $stmt->fetch();
            if (password_verify($password, $passwordHash)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username; // Optional: Store username for personalization
                header("Location: ./dashboard.php"); // Redirect to dashboard
                exit;
            } else {
                echo "Invalid credentials.";
            }
        } else {
            echo "User not found.";
        }
        $stmt->close();
    } else {
        echo "Statement preparation failed!";
    }
}
?>


<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>