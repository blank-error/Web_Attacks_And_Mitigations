<?php
$conn = new mysqli("localhost", "root", "", "webapp_proj");
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
        <a href="login_get.php">Logout</a>
    </div>
</div>

<div class="container">
    <div class="hero">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $conn->query("SELECT * FROM users WHERE id=$id");

            if ($result && $result->num_rows > 0) {
                $user = $result->fetch_assoc();
                echo "<h2>Welcome, " . $user['name'] . "!</h2>";
                echo "<p>Your profile details are shown below:</p>";
                echo "<table style='border-collapse: collapse; width: 100%; max-width: 500px; background-color: rgba(255,255,255,0.1); margin-top: 20px; border-radius: 10px; overflow: hidden;'>";
                echo "<tr style='background-color: var(--primary-color);'>";
                echo "<th style='padding: 12px;'>ID</th>";
                echo "<th style='padding: 12px;'>Name</th>";
                echo "<th style='padding: 12px;'>Email</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='padding: 10px;'>" . $user['id'] . "</td>";
                echo "<td style='padding: 10px;'>" . $user['name'] . "</td>";
                echo "<td style='padding: 10px;'>" . $user['email'] . "</td>";
                echo "</tr>";
                echo "</table>";
            } else {
                echo "<h3>User not found.</h3>";
            }
        } else {
            echo "<h3>No user ID provided.</h3>";
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
