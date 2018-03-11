<?php
session_start(); // start a session
require('inc/functions.php'); // including functions
require('inc/db.php'); // including the database connexion file 
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

?>
<ul>
    <li><a href="http://punkte.fr/">Home</a></li><!-- This will be changed to the public section link -->
    <li><a href="favorite.php">Add afeed</a></li>
    <li><a href="insert.php">Insert a feed into database (for development)</a></li>
    <li><a href="logout.php">logout</a></li>
</ul>
<div class="main-feed-container">
    <?php displayErrors(); // display errors in an alert div ?>
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
            <?= 'displayJsonNews("' . $ligne->api_url . '","' . $ligne->api_name . '","' . $ligne->api_id . '");' ?>
        <?php endwhile; ?>
    <?php endfor; ?>
<?php endif; ?>
</script>