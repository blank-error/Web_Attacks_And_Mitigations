<?php
session_start();
$conn = new mysqli("localhost", "root", "", "webapp_proj");

// Ensuring that the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_get.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetching the current user's profile
$stmt = $conn->prepare("SELECT * FROM users_safe WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h1>Game Portal</h1>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="index.php">Dashboard</a>
        <a href="index.php">Logout</a>
    </div>
</div>

<div class="container">
    <div class="hero">
        <?php
            if ($result && $result->num_rows > 0) {
                $user = $result->fetch_assoc();
                echo "<h2>Welcome, " . htmlspecialchars($user['name']) . "!</h2>";
                echo "<p>Your profile details are shown below:</p>";
                echo "<table style='border-collapse: collapse; width: 100%; max-width: 500px; background-color: rgba(255,255,255,0.1); margin-top: 20px; border-radius: 10px; overflow: hidden;'>";
                echo "<tr style='background-color: var(--primary-color);'>";
                echo "<th style='padding: 12px;'>ID</th>";
                echo "<th style='padding: 12px;'>Name</th>";
                echo "<th style='padding: 12px;'>Email</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='padding: 10px;'>" . htmlspecialchars($user['id']) . "</td>";
                echo "<td style='padding: 10px;'>" . htmlspecialchars($user['name']) . "</td>";
                echo "<td style='padding: 10px;'>" . htmlspecialchars($user['email']) . "</td>";
                echo "</tr>";
                echo "</table>";
            } else {
                echo "<h3>User not found.</h3>";
            }
        ?>
        <br>
        <a href="index.php">
            <button class="login-btn">Back to Dashboard</button>
        </a>
    </div>
</div>

<div class="footer">
    <p>&copy; 2025 Gaming Company. All rights reserved.</p>
</div>

</body>
</html>
