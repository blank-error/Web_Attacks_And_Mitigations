<?php
$conn = mysqli_connect("localhost", "root", "", "webapp_proj");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Creating the hash value of the passwords

    // Using prepared statement
    $stmt = $conn->prepare("INSERT INTO users_safe (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "<h2>Registration successful!</h2>";
    } else {
        echo "<h2>Error: " . $stmt->error . "</h2>";
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
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
