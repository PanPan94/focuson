<?php
session_start();
unset($_SESSION['auth']);
unset($_SESSION['user_favs']);
unset($_SESSION['lang']);
$_SESSION['flash']['success'] = "You have been disconnected";
header("Location: login.php");
exit();