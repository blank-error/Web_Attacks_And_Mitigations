<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming Arena</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <h1>Gaming Arena</h1>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Tournaments</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </div>
    </div>

    <?php
        $allowed_pages = ['index.php', 'login_get.php', 'login_post.php']; // pages that are allowed

        $page = isset($_GET['page']) ? basename($_GET['page']) : null;

        if ($page && in_array($page, $allowed_pages)) {
            include($page); // safely includes only from a known list and directory
        } else if ($page) {
            echo "Invalid page.";
        }
    ?>


    <div class="container">
        <div class="hero">
            <h2>Welcome to Gaming Arena</h2>
            <p>Your ultimate hub for gaming news, tournaments, and exclusive content.</p>

            <div class="buttons">
                <button class="join-btn" onclick="window.location.href='login_post.php'">Join Now</button>
                <button class="login-btn" onclick="window.location.href='login_get.php'">Login</button>
            </div>
        </div>

        <div class="comments">
            <h3>Leave a Comment</h3>
            <form action="comment.php" method="POST" class="comment-form">
                <input type="text" name="username" placeholder="Your Name" required>
                <textarea name="comment" placeholder="Your comment here..." required></textarea>
                <button type="submit">Submit</button>
            </form>

            <div class="comment-display">
                <?php
                    $file = "comments.txt";
                    if (!file_exists($file) || filesize($file) === 0){
                        echo "<p class='no-comments'>No comments yet.</p>";
                    } else {
                        $comments = file_get_contents($file);
                        echo "<div class='comment-box'>$comments</div>";
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Gaming Arena. All rights reserved.</p>
    </div>
</body>
</html>
