<?php
    $allowed_pages = ['index.php', 'login_get.php', 'login_post.php']; 

    $page = isset($_GET['page']) ? basename($_GET['page']) : null;

    if ($page && in_array($page, $allowed_pages)) {
        include($page); // safely includes only from a known list and directory
    } else if ($page) {
        echo "Invalid page.";
    }
?>
