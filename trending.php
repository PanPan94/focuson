<?php
require_once('inc/db.php');
require_once('inc/functions.php');
logged_only();
requireLanguage();
$req = $pdo->prepare('SELECT count(title), title, summary, sourcedImageFile, URLArticle, id_api FROM news GROUP BY title ORDER BY 1 DESC');
$req->execute();
setHeaderName('FocusOn - Bookmarks');
require_once('inc/menu.php');
?>

<div class="main-feed-container">
    <div class="errors-displaying">
        <?php displayErrors(); // display errors in an alert div ?>
    </div>
    <div class="news-container" id="news-container">

<?php
while($ligne = $req->fetch()) {
    ?>
    <div class="news-items">
        <div class="news-boxes">
        <h4><?= $ligne->title ?></h4>
        <img src="<?= $ligne->sourcedImageFile ?>" style="width: 100%" />
        <p><?= $ligne->summary ?></p>
        <a href="<?= $ligne->URLArticle ?>" target="_blank">See more...</a>
        </div>
    </div>
    <?php
}
?>

</div>
</div>
require_once('inc/footer.php');