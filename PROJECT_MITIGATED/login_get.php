<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "webapp_proj");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initializing login attempt counter
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Preventing Brute force by creating login limiter
if ($_SESSION['login_attempts'] >= 3) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['brute_force'] = true;
    echo "<script>alert('3 failed login attempts. Please try again.'); window.location.href='index.php';</script>";
    exit;
}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Using prepared statements to prevent a simple SQL injection attack
    $stmt = $conn->prepare("SELECT * FROM users_safe WHERE name = ? AND password = ?");
    $stmt->bind_param("ss", $name, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifying the password by using the password_verify function
        if (password_verify($password, $user['password'])){
            $_SESSION['login_attempts'] = 0; // Resetting login_attempts after successful login
            $_SESSION['user_id'] = $user['id']; // Storing the user_id in the current session
            header("Location: profile.php"); // Here we removed the ID in the url
            exit;
        } else {
            $_SESSION['login_attempts']++;
            echo "<h2> Invalid credentials. Attempt {$_SESSION['login_attempts']} of 3.</h2>";
        }
    } else {
        $_SESSION['login_attempts']++;
        echo "<h2>Invalid credentials. Attempt {$_SESSION['login_attempts']} of 3.</h2>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="login_get.php">   <!--  changing to POST METHOD for login  -->
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
