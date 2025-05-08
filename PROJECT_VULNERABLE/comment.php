<?php
if (isset($_POST['username']) && isset($_POST['comment'])) {
    $name = $_POST['username'];
    $comment = $_POST['comment'];
    $entry = "<p><strong>$name</strong>: $comment</p>\n";
    file_put_contents("comments.txt", $entry, FILE_APPEND);
    header("Location: index.php");
}
?>
