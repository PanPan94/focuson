<?php
/**
 * function setHeaderName
 * @param {string}
 * This function print the header and set the title name of the page
 */
function setHeaderName($titleName = "FocusOn") {
    ob_start();
    include("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $title = $titleName;
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;
}

function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

function displayErrors() {
    if(isset($_SESSION['flash'])){
        foreach($_SESSION['flash'] as $type=>$message) {
            echo '<div class="alert alert-' . $type . '"><p>' . $message . '</p></div>';
        }
        unset($_SESSION['flash']);
    }
}

function logged_only() {
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['auth'])) {
        $_SESSION['flash']['danger'] = "Access Denied";
        header('Location: login.php');
        exit();
    }
}