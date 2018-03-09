<?php
header("Access-Control-Allow-Origin: *");
session_start();
require('inc/functions.php');
require('inc/db.php');
logged_only();
setHeaderName();
displayErrors();
?>

<?php

$req = $pdo->prepare('SELECT * FROM favorites WHERE fav_user_id = ?');
$req->execute([
    $_SESSION['auth']->id
]);
$i = 0;
while($ligne = $req->fetch()) {
    $_SESSION['user_favs'][$i] = $ligne->fav_api_id;
    $i++;
}
?>
<div class="main-feed-container">
    <div class="news-container" id="news-container">
    </div>
</div>

<script>
<?php if(isset($_SESSION['user_favs'])): ?>
        <?php
            for($i = 0; $i < count($_SESSION['user_favs']); $i++) :
        ?>
        <?php
            $req = $pdo->prepare('SELECT api_url FROM apis WHERE api_id = ?');
            $req->execute([$_SESSION['user_favs'][$i]]);
        ?>
        <?php while($ligne = $req->fetch()) : ?>
            <?= 'displayJsonNews("' . $ligne->api_url . '");' ?>
        <?php endwhile; ?>
    <?php endfor; ?>
<?php endif; ?>
</script>