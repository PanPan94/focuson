<?php
session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "You have been disconnected";
header("Location: login.php");
exit();