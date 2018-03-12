<?php
require_once('inc/db.php');
require_once('inc/functions.php');
logged_only();
setHeaderName('FocusOn - Bookmarks');
require_once('inc/menu.php');
?>

<div class="main-feed-container">
    <div class="errors-displaying">
        <?php displayErrors(); // display errors in an alert div ?>
    </div>
    <div class="news-container" id="news-container">
    </div>
</div>