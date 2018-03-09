<?php
require_once('inc/db.php');
require_once('inc/functions.php');
setHeaderName('Fav something');
logged_only();

if(!empty($_POST) && isset($_SESSION['auth'])) {
    $user_id = $_SESSION['auth']->id;
    $api_id = $_POST['api_id'];
    $fav_exists = false;

    // Verification limit of 6
    $req = $pdo->prepare('SELECT * FROM favorites WHERE fav_user_id = ?');
    $req->execute([$user_id]);

    while($ligne = $req->fetch()) {
        if($ligne->fav_api_id == $api_id) {
            $fav_exists = true;
        }
    }
    $count = $req->rowCount();
    
    if($count < 6 && !$fav_exists) {
        $req = $pdo->prepare('INSERT INTO favorites SET fav_user_id = ?, fav_api_id = ?');
        $req->execute([$user_id, $api_id]);
        $_SESSION['flash']['success'] = "You've just added a news feed in your profile page.";
        header('Location: account.php');
    }
    
    if($fav_exists) {
        $_SESSION['flash']['danger'] = "Already added";
        header('Location: account.php');
        exit();
    }
    $req->closeCursor();
}

$req = $pdo->query('SELECT * FROM apis');

?>
<form action="" method="post">
    <select name="api_id">
    <?php 
        while($ligne = $req->fetch()) {
            echo '<option value="' . $ligne->api_id . '">' . $ligne->api_name . '</option>';
        }
    ?>
    </select>
    <button type="submit">Add</button>
</form>

<?php
    $req->closeCursor();