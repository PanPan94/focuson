<?php
require_once('inc/functions.php'); // including functions
session_start(); // starting a session to access all session variables
if(!isset($_SESSION['lang'])) {
    header('Location: language.php');
    exit();
}
requireLanguage();
if(isset($_SESSION['auth'])) {
    $_SESSION['flash']['success'] = "You are connected";
    header('Location: account.php');
    exit();
}
if(!empty($_POST) && !empty($_POST['username'] && !empty($_POST['password']))) {
    require_once('inc/db.php');
    $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username)');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    if(isset($user->password)) {
        if(password_verify($_POST['password'], $user->password)){
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = _CONNECTED ;
            header("Location: account.php");
            exit();
        }
    }
    else {
        $_SESSION['flash']['danger'] =  _INVALIDUSR ;
    }
}
setHeaderName("FocusOn - Login");
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
                            <h3><?= _START ?></h3>
                            <p>
                                <?=_PRJCT_DESC?>
                            </p>
                            <div class="next-btn"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="r-sidebar">
                <div class="r-sidebar-container">
                    <h3><?= _LOGIN ?></h3>
                    <?php
                        displayErrors();
                    ?>
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
                                    <span><?= _PASSWORD ?></span>
                                </div>
                                <div class="form-field-input">
                                    <input name="password" type="password">
                                </div>
                            </div>
                            <div class="submit">
                                <a href="register.php" style="border:none; cursor: pointer;" class="submit-btn" ><?= _REGISTER ?></a>
                                <a type="submit" style="border:none; cursor: pointer;"class="submit-btn" id="form-submit"><?= _LOGIN ?></a>
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