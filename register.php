<?php
session_start();
require_once('inc/functions.php');
if(!empty($_POST)) {
    $errors = array();
    // Informations to connect to the database
    require_once('inc/db.php');

    // Username validation
    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
        $errors['username'] = "Invalid username";
    }else {
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
        if($user){
            $errors['username'] = 'This username already exists';
        }
    }

    // Mail validation
    if(empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
        $errors['mail'] = "Invalid mail entered";
    }else {
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['mail']]);
        $user = $req->fetch();
        if($user){
            $errors['mail'] = 'This email already exists';
        }
    }

    // Password confirmation
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "Invalid password";
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
        $_SESSION['flash']['success'] = "A confirmation mail has been sent to your inbox.";
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
                            <h3>Let's get your set up !</h3>
                            <p>
                                It should only take a couple of minutes to get started
                            </p>
                            <div class="next-btn"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="r-sidebar">
                <div class="r-sidebar-container">
                    <h3>Create Account</h3>
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
                                    <span>Username</span>
                                </div>
                                <div class="form-field-input">
                                    <input name="username" type="text">
                                </div>
                            </div>
                            <div class="form-field">
                                <div class="form-field-label">
                                    <span>Email</span>
                                </div>
                                <div class="form-field-input">
                                    <input name="mail" type="text">
                                </div>
                            </div>
                            <div class="form-field">
                                <div class="form-field-label">
                                    <span>Password</span>
                                </div>
                                <div class="form-field-input">
                                    <input name="password" type="password">
                                </div>
                            </div>
                            <div class="form-field">
                                <div class="form-field-label">
                                    <span>Password Confirm</span>
                                </div>
                                <div class="form-field-input">
                                    <input name="password_confirm" type="password">
                                </div>
                            </div>
                            <div class="submit">
                                <a href="login.php" style="border:none; cursor: pointer;" class="submit-btn" >Login</a>
                                <a type="submit" style="border:none; cursor: pointer;"class="submit-btn" id="form-submit">Register</a>
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