<?php
$conn = mysqli_connect("localhost", "root", "", "webapp_proj");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['name']) && isset($_GET['email']) && isset($_GET['password'])) {
    $name = $_GET['name'];
    $email = $_GET['email'];
    $password = $_GET['password'];

    // VULNERABLE SQL QUERY
    $sql = "SELECT * FROM users WHERE name='$name' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userId = $user['id'];
        header("Location: profile.php?id=$userId");
    } else {
        echo "<h2>Invalid credentials.</h2>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login (GET)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login (GET Method)</h2>
        <form method="GET" action="login_get.php">
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
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</body>
</html>
