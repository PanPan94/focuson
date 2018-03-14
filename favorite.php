<?php
require_once('inc/db.php');
require_once('inc/functions.php');
logged_only();
requireLanguage();

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
        $_SESSION['flash']['success'] = _SCCS_ADD;
        header('Location: account.php');
    }
    
    if($fav_exists) {
        $_SESSION['flash']['danger'] = _ALR_ADD;
        header('Location: account.php');
        exit();
    }
    $req->closeCursor();
}

setHeaderName('Fav something');
$req = $pdo->query('SELECT * FROM apis');
require_once('inc/menu.php');
?>
<div class="errors-displaying">
        <?php displayErrors(); // display errors in an alert div ?>
    </div>
<div class="favorite">
    <div class="container">
<form action="" method="post">
<p>I'm searching for a </p>
    <select class="linked-select" data-target="#api_name" data-source="list.php?type=api_name&filter=$id" id="api_type">
        <option value="0">Select feeds type</option>
        <?php
            $categories = $pdo->query('SELECT DISTINCT api_category FROM apis');

            foreach($categories as $category) {
                ?>
                <option value="<?= $category->api_category ?>"><?= $category->api_category ?></option>
                <?php
            }
        ?>
    </select>
    <p>feed from the </p>
    <select name="api_id" id="api_name">
        <option value="0">Select feeds name</option>
    </select>
    <p> journal.<br></p>
    <button type="submit">Add</button>
</form>
</div>
</div>





<?php
    $req->closeCursor();