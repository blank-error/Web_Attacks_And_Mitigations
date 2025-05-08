<?php
if (isset($_POST['username']) && isset($_POST['comment'])) {
    // Sanitized user input
    $name = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');

    // Saving the sanitized comment
    $entry = "<p><strong>$name</strong>: $comment</p>\n";
    file_put_contents("comments.txt", $entry, FILE_APPEND);

    header("Location: index.php");
    exit;
}
?>
