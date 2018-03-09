<?php
session_start();
if(isset($_SESSION['auth'])) {
    $_SESSION['flash']['success'] = "You are connected";
    header('Location: account.php');
    exit();
}else {
    header('Location: login.php');
    exit();
}