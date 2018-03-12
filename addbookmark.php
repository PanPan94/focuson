<?php
require_once('inc/db.php');
require_once('inc/functions.php');

logged_only();

if(!empty($_POST) && isset($_SESSION['auth'])) {
    $req = $pdo->prepare('INSERT INTO news SET title = ?, sourcedImageFile = ?, summary = ?, URLArticle = ?, id_api = ?, user_id = ?');
    $req->execute([
        $_POST['title'],
        $_POST['img'],
        $_POST['desc'],
        $_POST['link'],
        $_POST['api_id'],
        $_SESSION['auth']->id
    ]);
    echo json_encode("Bookmark added !");
} 