<?php
    $conn = mysqli_connect("localhost", "root", "", "webapp_proj");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // VULNERABLE SQL INSERT (no sanitization)
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "<h2>Registration successful!</h2>";
        } else {
            echo "<h2>Error: " . mysqli_error($conn) . "</h2>";
        }

        mysqli_close($conn);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register (POST)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Register (POST Method)</h2>
        <form method="POST" action="login_post.php">
            <div class="input-group">
                <label for="name">Name:</label>
                <input type="text" name="name">
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="text" name="email">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password">
            </div>
            <button type="submit" class="login-btn">Register</button>
        </form>
    </div>
</body>
</html>
