<?php
session_start(); // start a session
require('inc/functions.php'); // including functions
require('inc/db.php'); // including the database connexion file 
setLanguage(); // Redirects the user if he has no language selected
requireLanguage();
logged_only(); // the user is disconnected if he is not connected
setHeaderName(); // Including the header of a simple html page no need to redefine it (inc/functions.php)
?>

<?php
if(isset($_GET['delete']) && isset($_SESSION['auth'])) {
    $del = $pdo->prepare('DELETE FROM favorites WHERE fav_user_id = ? AND fav_api_id = ?');
    $del->execute([$_SESSION['auth']->id, $_GET['delete']]);
    $_SESSION['user_favs'] = array();
    $_SESSION['flash']['success'] = "You've just deleted a feed";
    header('Location: account.php');
    exit();
}

$req = $pdo->prepare('SELECT * FROM favorites WHERE fav_user_id = ?');
$req->execute([
    $_SESSION['auth']->id
]);
$i = 0;
while($ligne = $req->fetch()) {
    $_SESSION['user_favs'][$i] = $ligne->fav_api_id;
    $i++;
}

require_once('inc/menu.php');
?>

<div class="main-feed-container">
    <div class="errors-displaying">
        <?php displayErrors(); // display errors in an alert div ?>
    </div>
    <div class="news-container" id="news-container">
    </div>
</div>

<script>
/**
 * I'm getting users favorites to display them by columns thanks to the displayJsonNews method (js/app.js)
 */
<?php if(isset($_SESSION['user_favs'])): ?>
    <?php for($i = 0; $i < count($_SESSION['user_favs']); $i++) : ?>
        <?php
            $req = $pdo->prepare('SELECT * FROM apis WHERE api_id = ?');
            $req->execute([$_SESSION['user_favs'][$i]]);
        ?>
        <?php while($ligne = $req->fetch()) : ?>
            <?php if($ligne->api_type == "json") : ?>
                <?= "\t" . 'displayJsonNews("' . $ligne->api_url . '","' . $ligne->api_name . '","' . $ligne->api_id . '");' . "\n" ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endfor; ?>
<?php endif; ?>
</script>