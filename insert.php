<?php
require_once('inc/db.php');
require_once('inc/functions.php');
logged_only();
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
    <select name="api_type" id="">
        <option value="json">JSON</option>
        <option value="xml">XML</option>
    </select>
    <br>

    <label for="api_category">api_category</label><br>
    <select name="api_category" id="">
        <option value="sport">Sport</option>
        <option value="nature">Nature</option>
        <option value="technology">Technology</option>
        <option value="political">Political</option>
        <option value="business">Business</option>
        <option value="science">Science</option>
        <option value="entertainment">Entairtainment</option>
    </select>
    <br>

    <input type="submit" value="insert">
</form>

<?php
require_once('inc/footer.php');
?>