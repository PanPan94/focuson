<?php
require_once('inc/db.php');
require_once('inc/functions.php');
logged_only();
requireLanguage();

if(isset($_GET['delete'])) {
    $req = $pdo->prepare('DELETE FROM news WHERE id = ? AND user_id = ?');
    $req->execute([$_GET['delete'], $_SESSION['auth']->id]);
    $_SESSION['flash']['success'] = "You've deleted a bookmark";
    header('Location: bookmarks.php');
    exit();
}
setHeaderName('FocusOn - Bookmarks');
require_once('inc/menu.php');

?>

<div class="main-feed-container">
    <div class="errors-displaying">
        <?php displayErrors(); // display errors in an alert div ?>
    </div>
    <div class="news-container" id="news-container">

    <?php
        $req = $pdo->prepare('SELECT * FROM news WHERE user_id = ?');
        $req->execute([$_SESSION['auth']->id]);

        while($ligne = $req->fetch()) :
    ?>
            <div class="news-items">
                <a class="delete-cross" href="bookmarks.php?delete=<?=$ligne->id?>"></a>
                <div class="news-boxes">
                <h4><?= $ligne->title ?></h4>
                <img src="<?= $ligne->sourcedImageFile ?>" style="width: 100%" />
                <p><?= $ligne->summary ?></p>
                <a href="<?= $ligne->URLArticle ?>" target="_blank">See more...</a>
                </div>
            </div>
    <?php
        endwhile;
    ?>
    </div>
</div>