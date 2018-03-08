<?php
session_start();
require('inc/functions.php');
setHeaderName();
displayErrors();

?>
<div class="main-feed-container">
    <div class="news-container">
        <div class="news-items" id="news-items"></div>
        <div class="news-items"></div>
        <div class="news-items"></div>
        <div class="news-items"></div>
        <div class="news-items"></div>
        <div class="news-items"></div>
    </div>
</div>

<script>
    displayJsonNews("https://newsapi.org/v2/top-headlines?sources=bbc-news&apiKey=b5df7b5046664a6e8fb250fa584d5542")
</script>