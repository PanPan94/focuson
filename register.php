<?php
session_start();
require_once('inc/functions.php');
setLanguage();
requireLanguage();
if(isset($_SESSION['auth'])) {
    $_SESSION['flash']['success'] = "You are connected";
    header('Location: account.php');
    exit();
}
if(!empty($_POST)) {
    $errors = array();
    // Informations to connect to the database
    require_once('inc/db.php');

    // Username validation
    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
        $errors['username'] = _IVDU;
    }else {
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
        if($user){
            $errors['username'] = _ALRDEXSTU ;
        }
    }

    // Mail validation
    if(empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
        $errors['mail'] = _IVDM ;
    }else {
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['mail']]);
        $user = $req->fetch();
        if($user){
            $errors['mail'] = _ALRDEXSTM ;
        }
    }

    // Password confirmation
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = _IVDP;
    }

    // Registering in database if $errors is empty
    if(empty($errors)) {
        $req = $pdo->prepare("INSERT INTO users SET username= ?, password = ?, email = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = str_random(60);
        $req->execute([$_POST['username'], $password , $_POST['mail']]);
        $user_id = $pdo->lastInsertId();
        $message = "Hi there !\nYou've just created an account in FocusOn !\nEnjoy";
        mail($_POST['mail'], "FocusOn account confirmation ", $message);
        $_SESSION['flash']['success'] = _RGT_S ;
        header('Location: login.php');
        exit();
    }

}

setHeaderName("FocusOn - Register");

?>
    <div class="register-container">
        <div class="register-box">
            <div class="l-sidebar">
                <div class="l-sidebar-container">
                    <div class="l-sidebar-content">
                        <div class="avatar">
                            <img src="img/default_profile.png" alt="default_profile">
                        </div>
                        <div class="avatar-welcome">
                            <h3><?= _START2 ?></h3>
                            <p>
                                <?= _RGT_DESC ?>
                            </p>
                            <div class="next-btn"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="r-sidebar">
                <div class="r-sidebar-container">
                    <h3><?= _REGISTER ?></h3>
                    <?php if(!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                            <?php
                                foreach($errors as $e){
                                    echo "<li>" . $e . "</li>";
                                }
                            ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="form">
                        <form action="" method="POST" id="form">
                            <div class="form-field">
                                <div class="form-field-label">
                                    <span><?= _USERNAME ?></span>
                                </div>
                                <div class="form-field-input">
                                    <input name="username" type="text">
                                </div>
                            </div>
                            <div class="form-field">
                                <div class="form-field-label">
                                    <span><?= _EMAIL ?></span>
                                </div>
                                <div class="form-field-input">
                                    <input name="mail" type="text">
                                </div>
                            </div>
                            <div class="form-field">
                                <div class="form-field-label">
                                    <span><?= _PASSWORD ?></span>
                                </div>
                                <div class="form-field-input">
                                    <input name="password" type="password">
                                </div>
                            </div>
                            <div class="form-field">
                                <div class="form-field-label">
                                    <span><?= _PASSWORDC ?></span>
                                </div>
                                <div class="form-field-input">
                                    <input name="password_confirm" type="password">
                                </div>
                            </div>
                            <div class="submit">
                                <a href="login.php" style="border:none; cursor: pointer;" class="submit-btn" ><?= _LOGIN ?></a>
                                <a type="submit" style="border:none; cursor: pointer;"class="submit-btn" id="form-submit"><?= _REGISTER ?></a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        var form = document.getElementById("form");
        document.getElementById("form-submit").addEventListener("click", function () {
            form.submit();
        });
    </script>
    <?php
        require_once('inc/footer.php');
    ?>