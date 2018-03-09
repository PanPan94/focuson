<?php
require_once('inc/db.php');
require_once('inc/functions.php');
setHeaderName('Insert Apis in database');

if(!empty($_POST)) {
    $req = $pdo->prepare('INSERT INTO apis SET api_name = ?, api_url = ?, api_type = ?, api_category = ?');
    $req->execute([
        $_POST['api_name'],
        $_POST['api_url'],
        $_POST['api_type'],
        $_POST['api_category']
    ]);
    $_SESSION['flash']['success'] = "You've just added an API";
    header('Location: account.php');
    exit();
} 
?>

<form action="" method="post">
    <label for="api_name">api_name</label><br>
    <input type="text" name="api_name" id=""><br>

    <label for="api_url">api_url</label><br>
    <input type="text" name="api_url" id=""><br>

    <label for="api_type">api_type</label><br>
    <input type="text" name="api_type" id=""><br>

    <label for="api_category">api_category</label><br>
    <input type="text" name="api_category" id=""><br>

    <input type="submit" value="insert">
</form>

<?php
require_once('inc/footer.php');
?>